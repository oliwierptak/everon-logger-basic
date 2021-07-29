<?php

/**
 * Everon logger configuration file. Auto-generated.
 */

declare(strict_types=1);

namespace Everon\Logger\Configurator\Plugin;

use UnexpectedValueException;

class ErrorLogLoggerPluginConfigurator implements \Everon\Logger\Contract\Configurator\PluginConfiguratorInterface
{
    protected const SHAPE_PROPERTIES = [
        'expandNewlines' => 'null|bool',
        'logLevel' => 'null|string',
        'messageType' => 'null|int',
        'pluginClass' => 'null|string',
        'pluginFactoryClass' => 'null|string',
        'shouldBubble' => 'null|bool',
    ];

    protected const METADATA = [
        'expandNewlines' => ['type' => 'bool', 'default' => false],
        'logLevel' => ['type' => 'string', 'default' => 'debug'],
        'messageType' => ['type' => 'int', 'default' => \Monolog\Handler\ErrorLogHandler::OPERATING_SYSTEM],
        'pluginClass' => ['type' => 'string', 'default' => \Everon\Logger\Plugin\ErrorLog\ErrorLogLoggerPlugin::class],
        'pluginFactoryClass' => ['type' => 'string', 'default' => null],
        'shouldBubble' => ['type' => 'bool', 'default' => true],
    ];

    /** If set to true, newlines in the message will be expanded to be take multiple log entries. */
    protected ?bool $expandNewlines = false;

    /** The minimum logging level at which this handler will be triggered */
    protected ?string $logLevel = 'debug';

    /** Says where the error should go. */
    protected ?int $messageType = \Monolog\Handler\ErrorLogHandler::OPERATING_SYSTEM;
    protected ?string $pluginClass = \Everon\Logger\Plugin\ErrorLog\ErrorLogLoggerPlugin::class;

    /** Defines custom plugin factory to be used to create a plugin */
    protected ?string $pluginFactoryClass = null;

    /** Whether the messages that are handled can bubble up the stack or not */
    protected ?bool $shouldBubble = true;
    protected array $updateMap = [];

    /**
     * If set to true, newlines in the message will be expanded to be take multiple log entries.
     */
    public function setExpandNewlines(?bool $expandNewlines): self
    {
        $this->expandNewlines = $expandNewlines; $this->updateMap['expandNewlines'] = true; return $this;
    }

    /**
     * If set to true, newlines in the message will be expanded to be take multiple log entries.
     */
    public function expandNewlines(): ?bool
    {
        return $this->expandNewlines;
    }

    /**
     * If set to true, newlines in the message will be expanded to be take multiple log entries.
     */
    public function requireExpandNewlines(): bool
    {
        $this->setupPopoProperty('expandNewlines');

        if ($this->expandNewlines === null) {
            throw new UnexpectedValueException('Required value of "expandNewlines" has not been set');
        }
        return $this->expandNewlines;
    }

    public function hasExpandNewlines(): bool
    {
        return $this->expandNewlines !== null;
    }

    /**
     * The minimum logging level at which this handler will be triggered
     */
    public function setLogLevel(?string $logLevel): self
    {
        $this->logLevel = $logLevel; $this->updateMap['logLevel'] = true; return $this;
    }

    /**
     * The minimum logging level at which this handler will be triggered
     */
    public function getLogLevel(): ?string
    {
        return $this->logLevel;
    }

    /**
     * The minimum logging level at which this handler will be triggered
     */
    public function requireLogLevel(): string
    {
        $this->setupPopoProperty('logLevel');

        if ($this->logLevel === null) {
            throw new UnexpectedValueException('Required value of "logLevel" has not been set');
        }
        return $this->logLevel;
    }

    public function hasLogLevel(): bool
    {
        return $this->logLevel !== null;
    }

    /**
     * Says where the error should go.
     */
    public function setMessageType(?int $messageType): self
    {
        $this->messageType = $messageType; $this->updateMap['messageType'] = true; return $this;
    }

    /**
     * Says where the error should go.
     */
    public function getMessageType(): ?int
    {
        return $this->messageType;
    }

    /**
     * Says where the error should go.
     */
    public function requireMessageType(): int
    {
        $this->setupPopoProperty('messageType');

        if ($this->messageType === null) {
            throw new UnexpectedValueException('Required value of "messageType" has not been set');
        }
        return $this->messageType;
    }

    public function hasMessageType(): bool
    {
        return $this->messageType !== null;
    }

    public function setPluginClass(?string $pluginClass): self
    {
        $this->pluginClass = $pluginClass; $this->updateMap['pluginClass'] = true; return $this;
    }

    public function getPluginClass(): ?string
    {
        return $this->pluginClass;
    }

    public function requirePluginClass(): string
    {
        $this->setupPopoProperty('pluginClass');

        if ($this->pluginClass === null) {
            throw new UnexpectedValueException('Required value of "pluginClass" has not been set');
        }
        return $this->pluginClass;
    }

    public function hasPluginClass(): bool
    {
        return $this->pluginClass !== null;
    }

    /**
     * Defines custom plugin factory to be used to create a plugin
     */
    public function setPluginFactoryClass(?string $pluginFactoryClass): self
    {
        $this->pluginFactoryClass = $pluginFactoryClass; $this->updateMap['pluginFactoryClass'] = true; return $this;
    }

    /**
     * Defines custom plugin factory to be used to create a plugin
     */
    public function getPluginFactoryClass(): ?string
    {
        return $this->pluginFactoryClass;
    }

    /**
     * Defines custom plugin factory to be used to create a plugin
     */
    public function requirePluginFactoryClass(): string
    {
        $this->setupPopoProperty('pluginFactoryClass');

        if ($this->pluginFactoryClass === null) {
            throw new UnexpectedValueException('Required value of "pluginFactoryClass" has not been set');
        }
        return $this->pluginFactoryClass;
    }

    public function hasPluginFactoryClass(): bool
    {
        return $this->pluginFactoryClass !== null;
    }

    /**
     * Whether the messages that are handled can bubble up the stack or not
     */
    public function setShouldBubble(?bool $shouldBubble): self
    {
        $this->shouldBubble = $shouldBubble; $this->updateMap['shouldBubble'] = true; return $this;
    }

    /**
     * Whether the messages that are handled can bubble up the stack or not
     */
    public function shouldBubble(): ?bool
    {
        return $this->shouldBubble;
    }

    /**
     * Whether the messages that are handled can bubble up the stack or not
     */
    public function requireShouldBubble(): bool
    {
        $this->setupPopoProperty('shouldBubble');

        if ($this->shouldBubble === null) {
            throw new UnexpectedValueException('Required value of "shouldBubble" has not been set');
        }
        return $this->shouldBubble;
    }

    public function hasShouldBubble(): bool
    {
        return $this->shouldBubble !== null;
    }

    #[\JetBrains\PhpStorm\ArrayShape(self::SHAPE_PROPERTIES)]
    public function toArray(): array
    {
        $data = [
            'expandNewlines' => $this->expandNewlines,
            'logLevel' => $this->logLevel,
            'messageType' => $this->messageType,
            'pluginClass' => $this->pluginClass,
            'pluginFactoryClass' => $this->pluginFactoryClass,
            'shouldBubble' => $this->shouldBubble,
        ];

        array_walk(
            $data,
            function (&$value, $name) use ($data) {
                $popo = static::METADATA[$name]['default'];
                if (static::METADATA[$name]['type'] === 'popo') {
                    $value = $this->$name !== null ? $this->$name->toArray() : (new $popo)->toArray();
                }
            }
        );

        return $data;
    }

    public function fromArray(#[\JetBrains\PhpStorm\ArrayShape(self::SHAPE_PROPERTIES)] array $data): self
    {
        foreach (static::METADATA as $name => $meta) {
            $value = $data[$name] ?? $this->$name ?? null;
            $popoValue = $meta['default'];

            if ($popoValue !== null && $meta['type'] === 'popo') {
                $popo = new $popoValue;

                if (is_array($value)) {
                    $popo->fromArray($value);
                }

                $value = $popo;
            }

            $this->$name = $value;
            $this->updateMap[$name] = true;
        }

        return $this;
    }

    public function isNew(): bool
    {
        return empty($this->updateMap) === true;
    }

    public function listModifiedProperties(): array
    {
        return array_keys($this->updateMap);
    }

    public function requireAll(): self
    {
        $errors = [];

        try {
            $this->requireExpandNewlines();
        }
        catch (\Throwable $throwable) {
            $errors['expandNewlines'] = $throwable->getMessage();
        }
        try {
            $this->requireLogLevel();
        }
        catch (\Throwable $throwable) {
            $errors['logLevel'] = $throwable->getMessage();
        }
        try {
            $this->requireMessageType();
        }
        catch (\Throwable $throwable) {
            $errors['messageType'] = $throwable->getMessage();
        }
        try {
            $this->requirePluginClass();
        }
        catch (\Throwable $throwable) {
            $errors['pluginClass'] = $throwable->getMessage();
        }
        try {
            $this->requirePluginFactoryClass();
        }
        catch (\Throwable $throwable) {
            $errors['pluginFactoryClass'] = $throwable->getMessage();
        }
        try {
            $this->requireShouldBubble();
        }
        catch (\Throwable $throwable) {
            $errors['shouldBubble'] = $throwable->getMessage();
        }

        if (empty($errors) === false) {
            throw new UnexpectedValueException(
                implode("\n", $errors)
            );
        }

        return $this;
    }

    protected function setupPopoProperty($propertyName): void
    {
        if (static::METADATA[$propertyName]['type'] === 'popo' && $this->$propertyName === null) {
            $popo = static::METADATA[$propertyName]['default'];
            $this->$propertyName = new $popo;
        }
    }
}
