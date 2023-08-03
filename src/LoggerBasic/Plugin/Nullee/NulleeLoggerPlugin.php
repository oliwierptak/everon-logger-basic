<?php

declare(strict_types = 1);

namespace Everon\LoggerBasic\Plugin\Nullee;

use Everon\Logger\Contract\Plugin\LoggerPluginInterface;
use Everon\Shared\LoggerBasic\Configurator\Plugin\NulleeLoggerPluginConfigurator;
use Monolog\Handler\HandlerInterface;
use Monolog\Handler\NullHandler;

class NulleeLoggerPlugin implements LoggerPluginInterface
{
    public function __construct(protected NulleeLoggerPluginConfigurator $configurator)
    {
    }

    public function canRun(): bool
    {
        return $this->configurator->hasLogLevel();
    }

    public function buildHandler(): HandlerInterface
    {
        return new NullHandler($this->configurator->requireLogLevel());
    }

    public function validate(): void
    {
        $this->configurator->requireLogLevel();
    }
}
