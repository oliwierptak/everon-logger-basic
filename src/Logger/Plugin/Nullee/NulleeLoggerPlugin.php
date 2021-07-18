<?php

declare(strict_types = 1);

namespace Everon\Logger\Plugin\Nullee;

use Everon\Logger\Configurator\Plugin\NulleeLoggerPluginConfigurator;
use Everon\Logger\Contract\Plugin\LoggerPluginInterface;
use Monolog\Handler\HandlerInterface;
use Monolog\Handler\NullHandler;

class NulleeLoggerPlugin implements LoggerPluginInterface
{
    protected NulleeLoggerPluginConfigurator $configurator;

    public function __construct(NulleeLoggerPluginConfigurator $configurator)
    {
        $this->configurator = $configurator;
    }

    public function canRun(): bool
    {
        return $this->configurator->hasLogLevel() && trim($this->configurator->getLogLevel()) !== '';
    }

    public function buildHandler(): HandlerInterface
    {
        return new NullHandler($this->configurator->getLogLevel());
    }

    public function validate(): void
    {
        $this->configurator->requireLogLevel();
    }
}
