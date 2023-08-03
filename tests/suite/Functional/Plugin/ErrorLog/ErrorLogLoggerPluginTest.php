<?php

declare(strict_types = 1);

namespace EveronLoggerTests\Suite\Functional\Plugin\ErrorLog;

use Everon\Logger\Exception\ConfiguratorValidationException;
use Everon\LoggerBasic\Plugin\ErrorLog\ErrorLogLoggerPlugin;
use Everon\Shared\LoggerBasic\Configurator\Plugin\ErrorLogLoggerPluginConfigurator;
use Everon\Shared\Testify\Logger\LoggerHelperTrait;
use EveronLoggerTests\Stub\Processor\MemoryUsageProcessorStub;
use EveronLoggerTests\Suite\Configurator\TestLoggerConfigurator;
use Monolog\Handler\ErrorLogHandler;
use Monolog\Level;
use PHPUnit\Framework\TestCase;

class ErrorLogLoggerPluginTest extends TestCase
{
    use LoggerHelperTrait;

    public function test_should_not_log_without_message_type(): void
    {
        $this->configurator->setValidateConfiguration(true);

        $this->expectException(ConfiguratorValidationException::class);
        $this->expectExceptionMessage('Required value of "messageType" has not been set');

        $this->configurator
            ->getConfiguratorByPluginName(ErrorLogLoggerPlugin::class)
            ->setMessageType(null);

        $logger = $this->facade->buildLogger($this->configurator);

        $logger->debug('foo bar');
    }

    public function test_should_not_log_when_level_too_low(): void
    {
        $this->configurator
            ->getConfiguratorByPluginName(ErrorLogLoggerPlugin::class)
            ->setLogLevel(Level::Info);

        $logger = $this->facade->buildLogger($this->configurator);

        $logger->debug('foo bar');

        $this->assertEmptyLogFile();
    }

    public function test_should_log(): void
    {
        $this->configurator
            ->getConfiguratorByPluginName(ErrorLogLoggerPlugin::class)
            ->setLogLevel(Level::Info);

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
            ->getConfiguratorByPluginName(ErrorLogLoggerPlugin::class)
            ->setLogLevel(Level::Info);

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
            ->getConfiguratorByPluginName(ErrorLogLoggerPlugin::class)
            ->setLogLevel(Level::Info);

        $logger = $this->facade->buildLogger($this->configurator);

        $logger->info('foo bar', ['buzz' => 'lorem ipsum']);

        $this->assertLogFile((new TestLoggerConfigurator())
            ->setMessage('foo bar')
            ->setLogLevel(Level::Info)
            ->setContext(['buzz' => 'lorem ipsum'])
            ->setExtra(['memory_peak_usage' => '5 MB']));
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->init();

        ini_set('error_log', $this->logFilename);

        $errorLogPluginConfigurator = (new ErrorLogLoggerPluginConfigurator())
            ->setPluginClass(ErrorLogLoggerPlugin::class)
            ->setLogLevel(Level::Debug)
            ->setMessageType(ErrorLogHandler::OPERATING_SYSTEM)
            ->setExpandNewlines(false);

        $this->configurator->add($errorLogPluginConfigurator);
    }
}
