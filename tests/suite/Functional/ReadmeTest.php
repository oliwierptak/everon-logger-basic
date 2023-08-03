<?php

declare(strict_types = 1);

namespace EveronLoggerTests\Suite\Functional;

use Everon\Logger\EveronLoggerFacade;
use Everon\Shared\Logger\Configurator\Plugin\LoggerConfigurator;
use Everon\Shared\LoggerBasic\Configurator\Plugin\StreamLoggerPluginConfigurator;
use Everon\Shared\LoggerBasic\Configurator\Plugin\SyslogLoggerPluginConfigurator;
use EveronLoggerTests\Stub\Processor\MemoryUsageProcessorStub;
use Monolog\Level;
use Monolog\Processor\HostnameProcessor;
use Monolog\Processor\MemoryUsageProcessor;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class ReadmeTest extends TestCase
{
    public function test_build_logger(): void
    {
        $streamPluginConfigurator = (new StreamLoggerPluginConfigurator)
            ->setLogLevel(Level::Info)
            ->setStreamLocation('/tmp/example.log');

        $configurator = (new LoggerConfigurator())
            ->add($streamPluginConfigurator)
            ->addProcessor(MemoryUsageProcessorStub::class);

        $logger = (new EveronLoggerFacade())->buildLogger($configurator);

        $logger->info('lorem ipsum');

        $this->assertInstanceOf(LoggerInterface::class, $logger);
        $this->assertFileExists('/tmp/example.log');
    }

    public function test_build_logger2(): void
    {
        $configurator = (new LoggerConfigurator())
            ->addProcessor(MemoryUsageProcessor::class)
            ->addProcessor(HostnameProcessor::class)
            ->add(
                (new StreamLoggerPluginConfigurator)
                    ->setLogLevel(Level::Debug)
                    ->setStreamLocation('/tmp/example.log')
            )->add(
                (new SyslogLoggerPluginConfigurator())
                    ->setLogLevel(Level::Info)
                    ->setIdent('everon-logger-ident')
            );

        $logger = (new EveronLoggerFacade())->buildLogger($configurator);

        $logger->debug('lorem ipsum');

        $this->assertInstanceOf(LoggerInterface::class, $logger);
        $this->assertFileExists('/tmp/example.log');
    }

    public function test_build_logger3(): void
    {
        $configurator = (new LoggerConfigurator())
            ->addProcessor(MemoryUsageProcessor::class)
            ->addProcessor(HostnameProcessor::class)
            ->add(
                (new StreamLoggerPluginConfigurator)
                    ->setLogLevel(Level::Debug)
                    ->setStreamLocation('/tmp/example.log')
            )->add(
                (new SyslogLoggerPluginConfigurator())
                    ->setLogLevel(Level::Info)
                    ->setIdent('everon-logger-ident')
            );

        $logger = (new EveronLoggerFacade())->buildLogger($configurator);

        $logger->debug('lorem ipsum');

        $this->assertInstanceOf(LoggerInterface::class, $logger);
        $this->assertFileExists('/tmp/example.log');
    }

    protected function setUp(): void
    {
        @unlink('/tmp/example.log');
    }
}
