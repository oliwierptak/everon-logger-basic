<?php

declare(strict_types = 1);

namespace EveronLoggerTests\Suite\Functional\Plugin\Stream;

use Everon\LoggerBasic\Plugin\Stream\StreamLoggerPlugin;
use Everon\Shared\LoggerBasic\Configurator\Plugin\StreamLoggerPluginConfigurator;
use Everon\Shared\Testify\Logger\LoggerHelperTrait;
use EveronLoggerTests\Stub\Plugin\Stream\FactoryStub;
use EveronLoggerTests\Stub\Processor\MemoryUsageProcessorStub;
use EveronLoggerTests\Suite\Configurator\TestLoggerConfigurator;
use Monolog\Level;
use PHPUnit\Framework\TestCase;

class StreamLoggerPluginTest extends TestCase
{
    use LoggerHelperTrait;

    public function test_should_not_log_without_logFile(): void
    {
        $this->configurator->setValidateConfiguration(false);
        $logger = $this->facade->buildLogger($this->configurator);

        $logger->debug('foo bar');

        $this->assertFileDoesNotExist($this->logFilename);
    }

    public function test_should_not_log_when_level_too_low(): void
    {
        $this->configurator
            ->setValidateConfiguration(false)
            ->getConfiguratorByPluginName(StreamLoggerPlugin::class)
            ->setLogLevel(Level::Info)
            ->setStreamLocation($this->logFilename);

        $logger = $this->facade->buildLogger($this->configurator);

        $logger->debug('foo bar');

        $this->assertFileDoesNotExist($this->logFilename);
    }

    public function test_should_log(): void
    {
        $this->configurator
            ->getConfiguratorByPluginName(StreamLoggerPlugin::class)
            ->setLogLevel(Level::Info)
            ->setStreamLocation($this->logFilename);

        $logger = $this->facade->buildLogger($this->configurator);

        $logger->info('foo bar');
        $this->assertLogFile(
            (new TestLoggerConfigurator())
                ->setMessage('foo bar')
                ->setLogLevel(Level::Info),
        );

        $logger->warning('foo bar warning');
        $this->assertLogFile(
            (new TestLoggerConfigurator())
                ->setMessage('foo bar warning')
                ->setLogLevel(Level::Warning),
        );
    }

    public function test_should_log_context(): void
    {
        $this->configurator
            ->getConfiguratorByPluginName(StreamLoggerPlugin::class)
            ->setLogLevel(Level::Info)
            ->setStreamLocation($this->logFilename);

        $logger = $this->facade->buildLogger($this->configurator);

        $logger->info('foo bar', ['buzz' => 'lorem ipsum']);

        $this->assertLogFile(
            (new TestLoggerConfigurator())
                ->setMessage('foo bar')
                ->setLogLevel(Level::Info)
                ->setContext(['buzz' => 'lorem ipsum']),
        );
    }

    public function test_should_log_context_and_extra(): void
    {
        $this->configurator
            ->addProcessor(MemoryUsageProcessorStub::class)
            ->getConfiguratorByPluginName(StreamLoggerPlugin::class)
            ->setLogLevel(Level::Info)
            ->setStreamLocation($this->logFilename);

        $logger = $this->facade->buildLogger($this->configurator);

        $logger->info('foo bar', ['buzz' => 'lorem ipsum']);

        $this->assertLogFile(
            (new TestLoggerConfigurator())
                ->setMessage('foo bar')
                ->setLogLevel(Level::Info)
                ->setContext(['buzz' => 'lorem ipsum'])
                ->setExtra(['memory_peak_usage' => '5 MB']),
        );
    }

    public function test_should_use_plugin_factory(): void
    {
        $this->configurator
            ->addProcessor(MemoryUsageProcessorStub::class)
            ->getConfiguratorByPluginName(StreamLoggerPlugin::class)
            ->setPluginFactoryClass(FactoryStub::class)
            ->setLogLevel(Level::Info)
            ->setStreamLocation($this->logFilename);

        $logger = $this->facade->buildLogger($this->configurator);

        $logger->info('foo bar', ['buzz' => 'lorem ipsum']);

        $this->assertLogFile(
            (new TestLoggerConfigurator())
                ->setMessage('foo bar')
                ->setLogLevel(Level::Info)
                ->setContext(['buzz' => 'lorem ipsum'])
                ->setExtra(['memory_peak_usage' => '5 MB']),
        );
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->init();

        $streamPluginConfigurator = (new StreamLoggerPluginConfigurator())
            ->setPluginClass(StreamLoggerPlugin::class)
            ->setLogLevel(Level::Debug);

        $this->configurator->add($streamPluginConfigurator);
    }
}
