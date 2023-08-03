<?php

declare(strict_types = 1);

namespace Everon\LoggerBasic\Plugin\Syslog;

use Everon\Logger\Contract\Plugin\LoggerPluginInterface;
use Everon\Shared\LoggerBasic\Configurator\Plugin\SyslogLoggerPluginConfigurator;
use Monolog\Handler\HandlerInterface;
use Monolog\Handler\SyslogHandler;
use Monolog\Logger;

class SyslogLoggerPlugin implements LoggerPluginInterface
{
    public function __construct(protected SyslogLoggerPluginConfigurator $configurator)
    {
    }

    public function canRun(): bool
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
