<?php

declare(strict_types = 1);

namespace EveronLoggerTests\Suit\Functional\Plugin\ErrorLog;

use Everon\Logger\Configurator\Plugin\ErrorLogLoggerPluginConfigurator;
use Everon\Logger\Exception\ConfiguratorValidationException;
use Everon\Logger\Plugin\ErrorLog\ErrorLogLoggerPlugin;
use EveronLoggerTests\Stub\Processor\MemoryUsageProcessorStub;
use EveronLoggerTests\Suit\Configurator\TestLoggerConfigurator;
use EveronLoggerTests\Suit\Functional\AbstractPluginLoggerTest;
use Monolog\Handler\ErrorLogHandler;

class ErrorLogLoggerPluginTest extends AbstractPluginLoggerTest
{
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
            ->setLogLevel('info');

        $logger = $this->facade->buildLogger($this->configurator);

        $logger->debug('foo bar');

        $this->assertEmptyLogFile();
    }

    public function test_should_log(): void
    {
        $this->configurator
            ->getConfiguratorByPluginName(ErrorLogLoggerPlugin::class)
            ->setLogLevel('info');

        $logger = $this->facade->buildLogger($this->configurator);

        $logger->info('foo bar');
        $this->assertLogFile((new TestLoggerConfigurator())
            ->setMessage('foo bar')
            ->setLevel('info'));

        $logger->warning('foo bar warning');
        $this->assertLogFile((new TestLoggerConfigurator())
            ->setMessage('foo bar warning')
            ->setLevel('warning'));
    }

    public function test_should_log_context(): void
    {
        $this->configurator
            ->getConfiguratorByPluginName(ErrorLogLoggerPlugin::class)
            ->setLogLevel('info');

        $logger = $this->facade->buildLogger($this->configurator);

        $logger->info('foo bar', ['buzz' => 'lorem ipsum']);

        $this->assertLogFile((new TestLoggerConfigurator())
            ->setMessage('foo bar')
            ->setLevel('info')
            ->setContext(['buzz' => 'lorem ipsum']));
    }

    public function test_should_log_context_and_extra(): void
    {
        $this->configurator
            ->addProcessorClass(MemoryUsageProcessorStub::class)
            ->getConfiguratorByPluginName(ErrorLogLoggerPlugin::class)
            ->setLogLevel('info');

        $logger = $this->facade->buildLogger($this->configurator);

        $logger->info('foo bar', ['buzz' => 'lorem ipsum']);

        $this->assertLogFile((new TestLoggerConfigurator())
            ->setMessage('foo bar')
            ->setLevel('info')
            ->setContext(['buzz' => 'lorem ipsum'])
            ->setExtra(['memory_peak_usage' => '5 MB']));
    }

    protected function setUp(): void
    {
        parent::setUp();

        ini_set('error_log', $this->logFilename);

        $errorLogPluginConfigurator = (new ErrorLogLoggerPluginConfigurator())
            ->setPluginClass(ErrorLogLoggerPlugin::class)
            ->setLogLevel('debug')
            ->setMessageType(ErrorLogHandler::OPERATING_SYSTEM)
            ->setExpandNewlines(false);

        $this->configurator->addPluginConfigurator($errorLogPluginConfigurator);
    }
}
