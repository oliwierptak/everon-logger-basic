<?php

declare(strict_types = 1);

namespace Everon\Logger\Plugin\ErrorLog;

use Everon\Logger\Configurator\Plugin\ErrorLogLoggerPluginConfigurator;
use Everon\Logger\Contract\Plugin\LoggerPluginInterface;
use JetBrains\PhpStorm\Pure;
use Monolog\Handler\ErrorLogHandler;
use Monolog\Handler\HandlerInterface;
use Monolog\Logger;

class ErrorLogLoggerPlugin implements LoggerPluginInterface
{
    protected ErrorLogLoggerPluginConfigurator $configurator;

    public function __construct(ErrorLogLoggerPluginConfigurator $configurator)
    {
        $this->configurator = $configurator;
    }

    #[Pure] public function canRun(): bool
    {
        return $this->configurator->hasMessageType();
    }

    public function buildHandler(): HandlerInterface
    {
        return new ErrorLogHandler(
            $this->configurator->getMessageType(),
            Logger::toMonologLevel($this->configurator->getLogLevel()),
            $this->configurator->shouldBubble(),
            $this->configurator->expandNewlines()
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
