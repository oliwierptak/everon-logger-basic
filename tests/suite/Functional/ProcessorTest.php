<?php

declare(strict_types = 1);


use Everon\Logger\EveronLoggerFacade;
use Everon\Shared\Logger\Configurator\Plugin\LoggerConfigurator;
use Everon\Shared\LoggerBasic\Configurator\Plugin\StreamLoggerPluginConfigurator;
use Everon\Shared\LoggerBasic\Configurator\Plugin\SyslogLoggerPluginConfigurator;
use Everon\Shared\Testify\Logger\LoggerHelperTrait;
use EveronLoggerTests\Stub\Processor\HostnameProcessorStub;
use EveronLoggerTests\Stub\Processor\MemoryUsageProcessorStub;
use EveronLoggerTests\Suite\Configurator\TestLoggerConfigurator;
use Monolog\Level;
use PHPUnit\Framework\TestCase;

class ProcessorTest extends TestCase
{
    use LoggerHelperTrait;

    public function test_build_memory_usage_processor(): void
    {
        $streamPluginConfigurator = (new StreamLoggerPluginConfigurator)
            ->setLogLevel(Level::Info)
            ->setStreamLocation($this->logFilename);

        $configurator = (new LoggerConfigurator())
            ->add($streamPluginConfigurator)
            ->addProcessor(MemoryUsageProcessorStub::class);

        $logger = (new EveronLoggerFacade())->buildLogger($configurator);

        $logger->info('lorem ipsum');

        $this->assertLogFile(
            (new TestLoggerConfigurator())
                ->setMessage('lorem ipsum')
                ->setLogLevel(Level::Info)
                ->setExtra([
                    'memory_peak_usage' => '5 MB',
                ]),
        );
    }

    public function test_build_multiple_processors_and_plugins(): void
    {
        $configurator = (new LoggerConfigurator())
            ->addProcessor(MemoryUsageProcessorStub::class)
            ->addProcessor(HostnameProcessorStub::class)
            ->add(
                (new StreamLoggerPluginConfigurator)
                    ->setLogLevel(Level::Debug)
                    ->setStreamLocation($this->logFilename),
            )->add(
                (new SyslogLoggerPluginConfigurator())
                    ->setLogLevel(Level::Info)
                    ->setIdent('everon-logger-ident'),
            );

        $logger = (new EveronLoggerFacade())->buildLogger($configurator);

        $logger->debug('lorem ipsum');

        $this->assertLogFile(
            (new TestLoggerConfigurator())
                ->setMessage('lorem ipsum')
                ->setLogLevel(Level::Debug)
                ->setExtra([
                    'memory_peak_usage' => '5 MB',
                    'hostname' => 'host.name',
                ]),
        );
    }

    protected function setUp(): void
    {
        ini_set('error_log', $this->logFilename);

        @unlink($this->logFilename);
    }
}
