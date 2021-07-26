<?php

declare(strict_types = 1);

namespace EveronLoggerTests\Suite\Functional\Builder;

use Everon\Logger\Configurator\Plugin\StreamLoggerPluginConfigurator;
use Everon\Logger\Exception\ConfiguratorValidationException;
use Everon\Logger\Plugin\Stream\StreamLoggerPlugin;
use EveronLoggerTests\Stub\Processor\MemoryUsageProcessorStub;
use EveronLoggerTests\Suite\Configurator\TestLoggerConfigurator;
use EveronLoggerTests\Suite\Functional\AbstractPluginLoggerTest;
use Psr\Log\LoggerInterface;

class BuildLoggerFromConfiguratorTest extends AbstractPluginLoggerTest
{
    public function test_build_empty_logger(): void
    {
        $logger = $this->facade->buildLogger($this->configurator);

        $this->assertInstanceOf(LoggerInterface::class, $logger);
    }

    public function test_should_throw_exception_when_builder_validation_fails(): void
    {
        $this->expectException(ConfiguratorValidationException::class);
        $this->expectExceptionMessage('Required value of "streamLocation" has not been set');

        $streamPluginConfigurator = (new StreamLoggerPluginConfigurator())
            ->setPluginClass(StreamLoggerPlugin::class);

        $this->configurator
            ->setValidateConfiguration(true)
            ->addPluginConfigurator($streamPluginConfigurator);

        $logger = $this->facade->buildLogger($this->configurator);

        $logger->debug('foo bar');

        $this->assertFileDoesNotExist($this->logFilename);
    }

    public function test_should_not_log_without_logFile(): void
    {
        $streamPluginConfigurator = (new StreamLoggerPluginConfigurator())
            ->setPluginClass(StreamLoggerPlugin::class);

        $this->configurator
            ->setValidateConfiguration(false)
            ->addPluginConfigurator($streamPluginConfigurator);

        $logger = $this->facade->buildLogger($this->configurator);

        $logger->debug('foo bar');

        $this->assertFileDoesNotExist($this->logFilename);
    }

    public function test_should_not_log_when_level_too_low(): void
    {
        $streamPluginConfigurator = (new StreamLoggerPluginConfigurator())
            ->setPluginClass(StreamLoggerPlugin::class)
            ->setLogLevel('info')
            ->setStreamLocation($this->logFilename);

        $this->configurator->addPluginConfigurator($streamPluginConfigurator);
        $logger = $this->facade->buildLogger($this->configurator);

        $logger->debug('foo bar');

        $this->assertFileDoesNotExist($this->logFilename);
    }

    public function test_should_log_extra(): void
    {
        $streamPluginConfigurator = (new StreamLoggerPluginConfigurator())
            ->setPluginClass(StreamLoggerPlugin::class)
            ->setLogLevel('info')
            ->setStreamLocation($this->logFilename);

        $this->configurator
            ->addPluginConfigurator($streamPluginConfigurator)
            ->addProcessorClass(MemoryUsageProcessorStub::class);

        $logger = $this->facade->buildLogger($this->configurator);

        $logger->info('foo bar');
        $this->assertLogFile((new TestLoggerConfigurator())
            ->setMessage('foo bar')
            ->setLevel('info')
            ->setExtra(['memory_peak_usage' => '5 MB']));

        $logger->warning('foo bar warning');
        $this->assertLogFile((new TestLoggerConfigurator())
            ->setMessage('foo bar warning')
            ->setLevel('warning')
            ->setExtra(['memory_peak_usage' => '5 MB']));
    }

    public function test_should_log_context_and_extra(): void
    {
        $streamPluginConfigurator = (new StreamLoggerPluginConfigurator())
            ->setPluginClass(StreamLoggerPlugin::class)
            ->setLogLevel('info')
            ->setStreamLocation($this->logFilename);

        $this->configurator
            ->addPluginConfigurator($streamPluginConfigurator)
            ->addProcessorClass(MemoryUsageProcessorStub::class);

        $logger = $this->facade->buildLogger($this->configurator);

        $logger->info('foo bar', ['buzz' => 'lorem ipsum']);

        $this->assertLogFile((new TestLoggerConfigurator())
            ->setMessage('foo bar')
            ->setLevel('info')
            ->setContext(['buzz' => 'lorem ipsum'])
            ->setExtra(['memory_peak_usage' => '5 MB']));
    }
}
