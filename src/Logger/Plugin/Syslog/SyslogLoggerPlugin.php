<?php

declare(strict_types = 1);

namespace Everon\Logger\Plugin\Syslog;

use Everon\Logger\Configurator\Plugin\SyslogLoggerPluginConfigurator;
use Everon\Logger\Contract\Plugin\LoggerPluginInterface;
use JetBrains\PhpStorm\Pure;
use Monolog\Handler\HandlerInterface;
use Monolog\Handler\SyslogHandler;
use Monolog\Logger;

class SyslogLoggerPlugin implements LoggerPluginInterface
{
    protected SyslogLoggerPluginConfigurator $configurator;

    public function __construct(SyslogLoggerPluginConfigurator $configurator)
    {
        $this->configurator = $configurator;
    }

    #[Pure] public function canRun(): bool
    {
        return $this->configurator->hasIdent() &&
            $this->configurator->hasFacility() &&
            $this->configurator->hasLogLevel();
    }

    public function buildHandler(): HandlerInterface
    {
        return new SyslogHandler(
            $this->configurator->requireIdent(),
            $this->configurator->requireFacility(),
            Logger::toMonologLevel($this->configurator->requireLogLevel()),
            $this->configurator->shouldBubble(),
            $this->configurator->getLogopts(),
        );
    }

    public function validate(): void
    {
        $this->configurator->requireIdent();
        $this->configurator->requireFacility();
        $this->configurator->requireLogLevel();
        $this->configurator->requireShouldBubble();
        $this->configurator->requireLogopts();
    }
}
