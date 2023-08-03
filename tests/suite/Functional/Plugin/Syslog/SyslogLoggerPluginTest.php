<?php

declare(strict_types = 1);

namespace EveronLoggerTests\Suite\Functional\Plugin\Syslog;

use Everon\Logger\Exception\ConfiguratorValidationException;
use Everon\LoggerBasic\Plugin\Syslog\SyslogLoggerPlugin;
use Everon\Shared\LoggerBasic\Configurator\Plugin\SyslogLoggerPluginConfigurator;
use Everon\Shared\Testify\Logger\LoggerHelperTrait;
use EveronLoggerTests\Stub\Processor\MemoryUsageProcessorStub;
use EveronLoggerTests\Suite\Configurator\TestLoggerConfigurator;
use Monolog\Level;
use PHPUnit\Framework\TestCase;
use function shell_exec;

class SyslogLoggerPluginTest extends TestCase
{
    use LoggerHelperTrait;

    public function test_should_not_log_without_ident(): void
    {
        $this->configurator->setValidateConfiguration(false);
        $logger = $this->facade->buildLogger($this->configurator);

        $logger->debug('foo bar');

        $this->assertEmptyLogFile();
    }
    public function test_should_validate_builder_configuration(): void
    {
        $this->expectException(ConfiguratorValidationException::class);
        $this->expectExceptionMessage('Required value of "ident" has not been set');

        $this->configurator->setValidateConfiguration(true);
        $logger = $this->facade->buildLogger($this->configurator);

        $logger->debug('foo bar');

        $this->assertEmptyLogFile();
    }

    public function test_should_not_log_when_level_too_low(): void
    {
        $this->configurator
            ->getConfiguratorByPluginName(SyslogLoggerPlugin::class)
            ->setLogLevel(Level::Info)
            ->setIdent('everon-logger-ident');

        $logger = $this->facade->buildLogger($this->configurator);

        $logger->debug('foo bar');

        $this->assertEmptyLogFile();
    }

    public function test_should_log(): void
    {
        $this->configurator
            ->getConfiguratorByPluginName(SyslogLoggerPlugin::class)
            ->setLogLevel(Level::Info)
            ->setIdent('everon-logger-ident');

        $logger = $this->facade->buildLogger($this->configurator);

        $logger->info('foo bar');
        $this->assertLogFile((new TestLoggerConfigurator())
            ->setMessage('foo bar')
            ->setLogLevel(Level::Info));

        $logger->warning('foo bar warning');
        $this->assertLogFile((new TestLoggerConfigurator())
            ->setMessage('foo bar warning')
            ->setLogLevel(Level::Warning));
    }

    public function test_should_log_context(): void
    {
        $this->configurator
            ->getConfiguratorByPluginName(SyslogLoggerPlugin::class)
            ->setLogLevel(Level::Info)
            ->setIdent('everon-logger-ident');

        $logger = $this->facade->buildLogger($this->configurator);

        $logger->info('foo bar', ['buzz' => 'lorem ipsum']);

        $this->assertLogFile((new TestLoggerConfigurator())
            ->setMessage('foo bar')
            ->setLogLevel(Level::Info)
            ->setContext(['buzz' => 'lorem ipsum']));
    }

    public function test_should_log_context_and_extra(): void
    {
        $this->configurator
            ->addProcessor(MemoryUsageProcessorStub::class)
            ->getConfiguratorByPluginName(SyslogLoggerPlugin::class)
            ->setLogLevel(Level::Info)
            ->setIdent('everon-logger-ident');

        $logger = $this->facade->buildLogger($this->configurator);

        $logger->info('foo bar', ['buzz' => 'lorem ipsum']);

        $this->assertLogFile((new TestLoggerConfigurator())
            ->setMessage('foo bar')
            ->setLogLevel(Level::Debug)
            ->setContext(['buzz' => 'lorem ipsum'])
            ->setExtra(['memory_peak_usage' => '5 MB']));
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->init();

        $syslogPluginConfigurator = (new SyslogLoggerPluginConfigurator())
            ->setPluginClass(SyslogLoggerPlugin::class)
            ->setLogLevel(Level::Debug);

        $this->configurator->add($syslogPluginConfigurator);

        shell_exec('truncate -s 0 ' . $this->logFilename);
    }
}
