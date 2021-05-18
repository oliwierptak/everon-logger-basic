# EveronLoggerBasic

Set of plugins that require no extra vendor dependencies for [EveronLogger](https://github.com/oliwierptak/everon-logger).

- ErrorLog
- Nullee
- Stream
- Syslog

## Plugins
 
### ErrorLog

Sends messages to PHP error_log() handler.
    
- Configurator

    `Everon\Logger\Configurator\Plugin\ErrorLogLoggerPluginConfigurator`
 
- Default Options

    ```php
    'pluginClass' => \Everon\Logger\Plugin\ErrorLog\ErrorLogLoggerPlugin::class,
    'pluginFactoryClass' => NULL,
    'logLevel' => 'debug',
    'shouldBubble' => true,
    'messageType' => \Monolog\Handler\ErrorLogHandler::OPERATING_SYSTEM,
    'expandNewlines' => false,
    ```
  
- Plugin

  `Everon\Logger\Plugin\ErrorLog\ErrorLogLoggerPlugin`
  
- Usage

    ```php
    use Everon\Logger\Configurator\Plugin\ErrorLogLoggerPluginConfigurator;
    use Everon\Logger\Configurator\Plugin\LoggerConfigurator;
  
    $errorLogPluginConfigurator = (new ErrorLogLoggerPluginConfigurator)
        ->setLogLevel('debug')
        ->setMessageType(\Monolog\Handler\ErrorLogHandler::OPERATING_SYSTEM)
        ->setExpandNewlines(false);
    
    $configurator = (new LoggerConfigurator)
        ->addPluginConfigurator($errorLogPluginConfigurator);
    
    $logger = (new EveronLoggerFacade())->buildLogger($configurator);
    
    $logger->info('lorem ipsum');
    ```  
  
### Nullee

Pretend to send messages
    
- Configurator

    `Everon\Logger\Configurator\Plugin\NulleeLoggerPluginConfigurator`
 
- Default Options

    ```php
    'pluginClass' => \Everon\Logger\Plugin\Nullee\NulleeLoggerPlugin::class,
    'pluginFactoryClass' => NULL,
    'logLevel' => 'debug',
    'shouldBubble' => true,
    ```
  
- Plugin

  `Everon\Logger\Plugin\Nullee\NulleeLoggerPlugin`
  
- Usage

    ```php
    use Everon\Logger\Configurator\Plugin\LoggerConfigurator;
    use Everon\Logger\Configurator\Plugin\NulleeLoggerPluginConfigurator;
  
    $nulleePluginConfigurator = (new NulleeLoggerPluginConfigurator)
        ->setLogLevel('debug');
    
    $configurator = (new LoggerConfigurator)
        ->addPluginConfigurator($nulleePluginConfigurator);
    
    $logger = (new EveronLoggerFacade())->buildLogger($configurator);
    
    $logger->info('lorem ipsum');
    ```    

### Stream

Sends messages to any PHP stream handler. 
    
- Configurator

    `Everon\Logger\Configurator\Plugin\StreamLoggerPluginConfigurator`
 
- Default Options

    ```php
    'pluginClass' => \Everon\Logger\Plugin\Stream\StreamLoggerPlugin::class,
    'pluginFactoryClass' => NULL,
    'logLevel' => 'debug',
    'shouldBubble' => true,
    'streamLocation' => NULL,
    'filePermission' => NULL,
    'useLocking' => false,
    ```
  
- Plugin

  `Everon\Logger\Plugin\Stream\StreamLoggerPlugin`
  
- Usage

    ```php
    use Everon\Logger\Configurator\Plugin\LoggerConfigurator;
    use Everon\Logger\Configurator\Plugin\StreamLoggerPluginConfigurator;
  
    $streamPluginConfigurator = (new StreamLoggerPluginConfigurator)
        ->setLogLevel('debug')
        ->setStreamLocation('/tmp/debug.log');
    
    $configurator = (new LoggerConfigurator)
        ->addPluginConfigurator($streamPluginConfigurator);
    
    $logger = (new EveronLoggerFacade())->buildLogger($configurator);
    
    $logger->info('lorem ipsum');
    ```    


### Syslog

Sends messages to syslog service.
    
- Configurator

    `Everon\Logger\Configurator\Plugin\SyslogLoggerPluginConfigurator`
 
- Default Options

    ```php
    'pluginClass' => \Everon\Logger\Plugin\Syslog\SyslogLoggerPlugin::class,
    'pluginFactoryClass' => NULL,
    'logLevel' => 'debug',
    'shouldBubble' => true,
    'ident' => NULL,
    'facility' => \LOG_LOCAL0,
    'logopts' => \LOG_PID,
    ```
  
- Plugin

  `Everon\Logger\Plugin\Syslog\SyslogLoggerPlugin`
  
- Usage

    ```php
    use Everon\Logger\Configurator\Plugin\LoggerConfigurator;
    use Everon\Logger\Configurator\Plugin\SyslogLoggerPluginConfigurator;
  
    $syslogPluginConfigurator = (new SyslogLoggerPluginConfigurator)
        ->setLogLevel('warning')
        ->setIdent('foo-bar-ident');
    
    $configurator = (new LoggerConfigurator)
        ->addPluginConfigurator($syslogPluginConfigurator);
    
    $logger = (new EveronLoggerFacade())->buildLogger($configurator);
    
    $logger->info('lorem ipsum');
    ```    

## Requirements

- PHP v8.x

_Note_: Use v1.x for compatibility with PHP v7.4.

## Installation

```
composer require everon/logger-basic
```
