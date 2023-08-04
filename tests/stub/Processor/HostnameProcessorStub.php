<?php

declare(strict_types = 1);

namespace EveronLoggerTests\Stub\Processor;

use Monolog\LogRecord;
use Monolog\Processor\HostnameProcessor;

class HostnameProcessorStub extends HostnameProcessor
{
    public function __invoke(LogRecord $record): LogRecord
    {
        $record->extra['hostname'] = 'host.name';

        return $record;
    }
}
