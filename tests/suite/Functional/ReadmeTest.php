<?php

declare(strict_types = 1);

namespace EveronLoggerTests\Suite\Functional;

use Everon\Logger\EveronLoggerFacade;
use Everon\Shared\Logger\Configurator\Plugin\LoggerConfigurator;
use Everon\Shared\LoggerBasic\Configurator\Plugin\ErrorLogLoggerPluginConfigurator;
use Everon\Shared\LoggerBasic\Configurator\Plugin\NulleeLoggerPluginConfigurator;
use Everon\Shared\LoggerBasic\Configurator\Plugin\StreamLoggerPluginConfigurator;
use Everon\Shared\LoggerBasic\Configurator\Plugin\SyslogLoggerPluginConfigurator;
use Everon\Shared\Testify\Logger\LoggerHelperTrait;
use EveronLoggerTests\Suite\Configurator\TestLoggerConfigurator;
use Monolog\Handler\ErrorLogHandler;
use Monolog\Level;
use PHPUnit\Framework\TestCase;

class ReadmeTest extends TestCase
{
    use LoggerHelperTrait;

    public function test_error_logger_plugin(): void
    {
        $errorLogPluginConfigurator = (new ErrorLogLoggerPluginConfigurator())
            ->setLogLevel(Level::Debug)
            ->setMessageType(ErrorLogHandler::OPERATING_SYSTEM)
            ->setExpandNewlines(false);

        $configurator = (new LoggerConfigurator)
            ->add($errorLogPluginConfigurator);

        $logger = (new EveronLoggerFacade())->buildLogger($configurator);

        $logger->info('lorem ipsum');

        $this->assertLogFile(
            (new TestLoggerConfigurator())
                ->setMessage('lorem ipsum')
                ->setLogLevel(Level::Info),
        );
    }

    public function test_nulee_logger_plugin(): void
    {
        $nulleePluginConfigurator = (new NulleeLoggerPluginConfigurator())
            ->setLogLevel(Level::Debug);

        $configurator = (new LoggerConfigurator)
            ->add($nulleePluginConfigurator);

        $logger = (new EveronLoggerFacade())->buildLogger($configurator);

        $logger->info('lorem ipsum');

        $this->assertEmptyLogFile();
    }

    public function test_stream_logger_plugin(): void
    {
        $streamPluginConfigurator = (new StreamLoggerPluginConfigurator())
            ->setLogLevel(Level::Debug)
            ->setStreamLocation($this->logFilename);

        $configurator = (new LoggerConfigurator)
            ->add($streamPluginConfigurator);

        $logger = (new EveronLoggerFacade())->buildLogger($configurator);

        $logger->info('lorem ipsum');

        $this->assertLogFile(
            (new TestLoggerConfigurator())
                ->setMessage('lorem ipsum')
                ->setLogLevel(Level::Info),
        );
    }

    public function test_syslog_logger_plugin(): void
    {
        $syslogPluginConfigurator = (new SyslogLoggerPluginConfigurator())
            ->setLogLevel(Level::Info)
            ->setIdent('foo-bar-ident');

        $configurator = (new LoggerConfigurator)
            ->add($syslogPluginConfigurator);

        $logger = (new EveronLoggerFacade())->buildLogger($configurator);

        $logger->info('lorem ipsum');
        
        $this->assertEmptyLogFile();
    }

    protected function setUp(): void
    {
        ini_set('error_log', $this->logFilename);

        @unlink($this->logFilename);
    }
}
