<?php

declare(strict_types = 1);

namespace Everon\LoggerBasic\Plugin\Stream;

use Everon\Logger\Contract\Plugin\LoggerPluginInterface;
use Everon\Shared\LoggerBasic\Configurator\Plugin\StreamLoggerPluginConfigurator;
use Monolog\Handler\HandlerInterface;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class StreamLoggerPlugin implements LoggerPluginInterface
{
    public function __construct(protected StreamLoggerPluginConfigurator $configurator)
    {
    }

    public function canRun(): bool
    {
        return $this->configurator->hasStreamLocation() && $this->configurator->hasLogLevel();
    }

    public function buildHandler(): HandlerInterface
    {
        return new StreamHandler(
            $this->configurator->requireStreamLocation(),
            Logger::toMonologLevel($this->configurator->requireLogLevel()),
            $this->configurator->shouldBubble(),
            $this->configurator->getFilePermission(),
            $this->configurator->useLocking()
        );
    }

    public function validate(): void
    {
        $this->configurator->requireStreamLocation();
        $this->configurator->requireLogLevel();
        $this->configurator->requireShouldBubble();
        $this->configurator->requireFilePermission();
        $this->configurator->requireUseLocking();
    }
}
