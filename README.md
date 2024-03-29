# EveronLoggerBasic

[![Build and run tests](https://github.com/oliwierptak/everon-logger-basic/actions/workflows/main.yml/badge.svg)](https://github.com/oliwierptak/everon-logger-basic/actions/workflows/main.yml)

Set of plugins that require no extra vendor dependencies
for [EveronLogger](https://github.com/oliwierptak/everon-logger).

- ErrorLog
- Nullee
- Stream
- Syslog

## Plugins

### ErrorLog

Sends messages to PHP error_log() handler.

- Configurator

  `Everon\Shared\LoggerBasic\Configurator\Plugin\ErrorLogLoggerPluginConfigurator`

- Default Options

    ```php
    'pluginClass' => \Everon\LoggerBasic\Plugin\ErrorLog\ErrorLogLoggerPlugin::class,
    'pluginFactoryClass' => NULL,
    'logLevel' => Level::Debug,
    'shouldBubble' => true,
    'messageType' => \Monolog\Handler\ErrorLogHandler::OPERATING_SYSTEM,
    'expandNewlines' => false,
    ```

- Plugin

  `Everon\LoggerBasic\Plugin\ErrorLog\ErrorLogLoggerPlugin`

- Usage

    ```php
    use Everon\Shared\Logger\Configurator\Plugin\LoggerConfigurator;
    use Everon\Shared\LoggerBasic\Configurator\Plugin\ErrorLogLoggerPluginConfigurator;
    use Everon\Logger\EveronLoggerFacade;
  
    $errorLogPluginConfigurator = (new ErrorLogLoggerPluginConfigurator)
        ->setLogLevel(Level::Info)
        ->setMessageType(\Monolog\Handler\ErrorLogHandler::OPERATING_SYSTEM)
        ->setExpandNewlines(false);
    
    $configurator = (new LoggerConfigurator)
        ->add($errorLogPluginConfigurator);
    
    $logger = (new EveronLoggerFacade())->buildLogger($configurator);
    
    $logger->info('lorem ipsum');
    ```  

### Nullee

Pretend to send messages

- Configurator

  `Everon\Shared\LoggerBasic\Configurator\Plugin\NulleeLoggerPluginConfigurator`

- Default Options

    ```php
    'pluginClass' => \Everon\LoggerBasic\Plugin\Nullee\NulleeLoggerPlugin::class,
    'pluginFactoryClass' => NULL,
    'logLevel' => Level::Debug,
    'shouldBubble' => true,
    ```

- Plugin

  `Everon\LoggerBasic\Plugin\Nullee\NulleeLoggerPlugin`

- Usage

    ```php
    use Everon\Shared\Logger\Configurator\Plugin\LoggerConfigurator;
    use Everon\Shared\LoggerBasic\Configurator\Plugin\NulleeLoggerPluginConfigurator;
    use Everon\Logger\EveronLoggerFacade;
  
    $nulleePluginConfigurator = (new NulleeLoggerPluginConfigurator)
        ->setLogLevel(Level::Info);
    
    $configurator = (new LoggerConfigurator)
        ->add($nulleePluginConfigurator);
    
    $logger = (new EveronLoggerFacade())->buildLogger($configurator);
    
    $logger->info('lorem ipsum');
    ```    

### Stream

Sends messages to any PHP stream handler.

- Configurator

  `Everon\Shared\LoggerBasic\Configurator\Plugin\StreamLoggerPluginConfigurator`

- Default Options

    ```php
    'pluginClass' => \Everon\LoggerBasic\Plugin\Stream\StreamLoggerPlugin::class,
    'pluginFactoryClass' => NULL,
    'logLevel' => Level::Debug,
    'shouldBubble' => true,
    'streamLocation' => NULL,
    'filePermission' => NULL,
    'useLocking' => false,
    ```

- Plugin

  `Everon\LoggerBasic\Plugin\Stream\StreamLoggerPlugin`

- Usage

    ```php
    use Everon\Shared\Logger\Configurator\Plugin\LoggerConfigurator;
    use Everon\Shared\LoggerBasic\Configurator\Plugin\StreamLoggerPluginConfigurator; 
    use Everon\Logger\EveronLoggerFacade;
  
    $streamPluginConfigurator = (new StreamLoggerPluginConfigurator)
        ->setLogLevel(Level::Info)
        ->setStreamLocation('/tmp/debug.log');
    
    $configurator = (new LoggerConfigurator)
        ->add($streamPluginConfigurator);
    
    $logger = (new EveronLoggerFacade())->buildLogger($configurator);
    
    $logger->info('lorem ipsum');
    ```    

### Syslog

Sends messages to syslog service.

- Configurator

  `Everon\Shared\LoggerBasic\Configurator\Plugin\SyslogLoggerPluginConfigurator`

- Default Options

    ```php
    'pluginClass' => \Everon\LoggerBasic\Plugin\Syslog\SyslogLoggerPlugin::class,
    'pluginFactoryClass' => NULL,
    'logLevel' => Level::Debug,
    'shouldBubble' => true,
    'ident' => NULL,
    'facility' => \LOG_LOCAL0,
    'logopts' => \LOG_PID,
    ```

- Plugin

  `Everon\LoggerBasic\Plugin\Syslog\SyslogLoggerPlugin`

- Usage

    ```php
    use Everon\Shared\Logger\Configurator\Plugin\LoggerConfigurator; 
    use Everon\Shared\LoggerBasic\Configurator\Plugin\SyslogLoggerPluginConfigurator;
    use Everon\Logger\EveronLoggerFacade;
  
    $syslogPluginConfigurator = (new SyslogLoggerPluginConfigurator)
        ->setLogLevel(Level::Info)
        ->setIdent('foo-bar-ident');
    
    $configurator = (new LoggerConfigurator)
        ->add($syslogPluginConfigurator);
    
    $logger = (new EveronLoggerFacade())->buildLogger($configurator);
    
    $logger->info('lorem ipsum');
    ```    

## Requirements

- PHP v8.1.x
- Monolog v3.x

## Installation

```
composer require everon/logger-basic
```
