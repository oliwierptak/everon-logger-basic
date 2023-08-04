<?php

declare(strict_types = 1);

namespace Everon\LoggerBasic\Plugin\ErrorLog;

use Everon\Logger\Contract\Plugin\LoggerPluginInterface;
use Everon\Shared\LoggerBasic\Configurator\Plugin\ErrorLogLoggerPluginConfigurator;
use Monolog\Handler\ErrorLogHandler;
use Monolog\Handler\HandlerInterface;
use Monolog\Logger;

class ErrorLogLoggerPlugin implements LoggerPluginInterface
{
    public function __construct(protected ErrorLogLoggerPluginConfigurator $configurator) {}

    public function canRun(): bool
    {
        return $this->configurator->hasMessageType() && $this->configurator->hasLogLevel();
    }

    public function buildHandler(): HandlerInterface
    {
        return new ErrorLogHandler(
            $this->configurator->requireMessageType(),
            Logger::toMonologLevel($this->configurator->requireLogLevel()),
            (bool)$this->configurator->shouldBubble(),
            (bool)$this->configurator->expandNewlines(),
        );
    }

    public function validate(): void
    {
        $this->configurator->requireMessageType();
        $this->configurator->requireLogLevel();
        $this->configurator->requireShouldBubble();
        $this->configurator->requireExpandNewlines();
    }
}
