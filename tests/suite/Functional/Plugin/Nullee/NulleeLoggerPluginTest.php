<?php

declare(strict_types = 1);

namespace EveronLoggerTests\Suite\Functional\Plugin\Nullee;

use Everon\Logger\Configurator\Plugin\NulleeLoggerPluginConfigurator;
use Everon\Logger\Plugin\Nullee\NulleeLoggerPlugin;
use EveronLoggerTests\Suite\Functional\AbstractPluginLoggerTest;

class NulleeLoggerPluginTest extends AbstractPluginLoggerTest
{
    public function test_should_not_log(): void
    {
        $this->configurator
            ->getConfiguratorByPluginName(NulleeLoggerPlugin::class)
            ->setLogLevel('info');

        $logger = $this->facade->buildLogger($this->configurator);

        $logger->info('foo bar');
        $logger->warning('foo bar warning');

        $this->assertEmptyLogFile();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $nulleePluginConfigurator = (new NulleeLoggerPluginConfigurator())
            ->setLogLevel('debug');

        $this->configurator->addPluginConfigurator($nulleePluginConfigurator);
    }
}
