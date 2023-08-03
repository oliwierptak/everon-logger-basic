<?php

declare(strict_types = 1);

namespace EveronLoggerTests\Suite\Functional\Plugin\Nullee;

use Everon\LoggerBasic\Plugin\Nullee\NulleeLoggerPlugin;
use Everon\Shared\LoggerBasic\Configurator\Plugin\NulleeLoggerPluginConfigurator;
use Everon\Shared\Testify\Logger\LoggerHelperTrait;
use Monolog\Level;
use PHPUnit\Framework\TestCase;

class NulleeLoggerPluginTest extends TestCase
{
    use LoggerHelperTrait;

    public function test_should_not_log(): void
    {
        $this->configurator
            ->getConfiguratorByPluginName(NulleeLoggerPlugin::class)
            ->setLogLevel(Level::Info);

        $logger = $this->facade->buildLogger($this->configurator);

        $logger->info('foo bar');
        $logger->warning('foo bar warning');

        $this->assertEmptyLogFile();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->init();

        $nulleePluginConfigurator = (new NulleeLoggerPluginConfigurator())
            ->setLogLevel(Level::Debug);

        $this->configurator->add($nulleePluginConfigurator);
    }
}
