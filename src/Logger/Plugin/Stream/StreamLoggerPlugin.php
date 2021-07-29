<?php

declare(strict_types = 1);

namespace Everon\Logger\Plugin\Stream;

use Everon\Logger\Configurator\Plugin\StreamLoggerPluginConfigurator;
use Everon\Logger\Contract\Plugin\LoggerPluginInterface;
use JetBrains\PhpStorm\Pure;
use Monolog\Handler\HandlerInterface;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class StreamLoggerPlugin implements LoggerPluginInterface
{
    public function __construct(protected StreamLoggerPluginConfigurator $configurator)
    {
    }

    #[Pure] public function canRun(): bool
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
