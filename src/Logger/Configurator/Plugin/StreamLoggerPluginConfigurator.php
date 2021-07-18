<?php

/**
 * Everon logger configuration file. Auto-generated.
 */

declare(strict_types=1);

namespace Everon\Logger\Configurator\Plugin;

use UnexpectedValueException;

class StreamLoggerPluginConfigurator implements \Everon\Logger\Contract\Configurator\PluginConfiguratorInterface
{
    protected const SHAPE_PROPERTIES = [
        'filePermission' => 'null|int',
        'logLevel' => 'null|string',
        'pluginClass' => 'null|string',
        'pluginFactoryClass' => 'null|string',
        'shouldBubble' => 'null|bool',
        'streamLocation' => 'null|string',
        'useLocking' => 'null|bool',
    ];

    protected const METADATA = [
        'filePermission' => ['type' => 'int', 'default' => 420],
        'logLevel' => ['type' => 'string', 'default' => 'debug'],
        'pluginClass' => ['type' => 'string', 'default' => \Everon\Logger\Plugin\Stream\StreamLoggerPlugin::class],
        'pluginFactoryClass' => ['type' => 'string', 'default' => null],
        'shouldBubble' => ['type' => 'bool', 'default' => true],
        'streamLocation' => ['type' => 'string', 'default' => null],
        'useLocking' => ['type' => 'bool', 'default' => false],
    ];

    /** Optional file permissions (default (0644) are only for owner read/write). */
    protected ?int $filePermission = 420;

    /** The minimum logging level at which this handler will be triggered */
    protected ?string $logLevel = 'debug';
    protected ?string $pluginClass = \Everon\Logger\Plugin\Stream\StreamLoggerPlugin::class;

    /** Defines custom plugin factory to be used to create a plugin */
    protected ?string $pluginFactoryClass = null;

    /** Whether the messages that are handled can bubble up the stack or not */
    protected ?bool $shouldBubble = true;

    /** If a missing path can't be created, an UnexpectedValueException will be thrown on first write. */
    protected ?string $streamLocation = null;

    /** Try to lock log file before doing any writes. */
    protected ?bool $useLocking = false;
    protected array $updateMap = [];

    /**
     * Optional file permissions (default (0644) are only for owner read/write).
     */
    public function setFilePermission(?int $filePermission): self
    {
        $this->filePermission = $filePermission; $this->updateMap['filePermission'] = true; return $this;
    }

    /**
     * Optional file permissions (default (0644) are only for owner read/write).
     */
    public function getFilePermission(): ?int
    {
        return $this->filePermission;
    }

    /**
     * Optional file permissions (default (0644) are only for owner read/write).
     */
    public function requireFilePermission(): int
    {
        if (static::METADATA['filePermission']['type'] === 'popo' && $this->filePermission === null) {
            $popo = static::METADATA['filePermission']['default'];
            $this->filePermission = new $popo;
        }

        if ($this->filePermission === null) {
            throw new UnexpectedValueException('Required value of "filePermission" has not been set');
        }
        return $this->filePermission;
    }

    public function hasFilePermission(): bool
    {
        return $this->filePermission !== null || ($this->filePermission !== null && array_key_exists('filePermission', $this->updateMap));
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
        if (static::METADATA['logLevel']['type'] === 'popo' && $this->logLevel === null) {
            $popo = static::METADATA['logLevel']['default'];
            $this->logLevel = new $popo;
        }

        if ($this->logLevel === null) {
            throw new UnexpectedValueException('Required value of "logLevel" has not been set');
        }
        return $this->logLevel;
    }

    public function hasLogLevel(): bool
    {
        return $this->logLevel !== null || ($this->logLevel !== null && array_key_exists('logLevel', $this->updateMap));
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
        if (static::METADATA['pluginClass']['type'] === 'popo' && $this->pluginClass === null) {
            $popo = static::METADATA['pluginClass']['default'];
            $this->pluginClass = new $popo;
        }

        if ($this->pluginClass === null) {
            throw new UnexpectedValueException('Required value of "pluginClass" has not been set');
        }
        return $this->pluginClass;
    }

    public function hasPluginClass(): bool
    {
        return $this->pluginClass !== null || ($this->pluginClass !== null && array_key_exists('pluginClass', $this->updateMap));
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
        if (static::METADATA['pluginFactoryClass']['type'] === 'popo' && $this->pluginFactoryClass === null) {
            $popo = static::METADATA['pluginFactoryClass']['default'];
            $this->pluginFactoryClass = new $popo;
        }

        if ($this->pluginFactoryClass === null) {
            throw new UnexpectedValueException('Required value of "pluginFactoryClass" has not been set');
        }
        return $this->pluginFactoryClass;
    }

    public function hasPluginFactoryClass(): bool
    {
        return $this->pluginFactoryClass !== null || ($this->pluginFactoryClass !== null && array_key_exists('pluginFactoryClass', $this->updateMap));
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
        if (static::METADATA['shouldBubble']['type'] === 'popo' && $this->shouldBubble === null) {
            $popo = static::METADATA['shouldBubble']['default'];
            $this->shouldBubble = new $popo;
        }

        if ($this->shouldBubble === null) {
            throw new UnexpectedValueException('Required value of "shouldBubble" has not been set');
        }
        return $this->shouldBubble;
    }

    public function hasShouldBubble(): bool
    {
        return $this->shouldBubble !== null || ($this->shouldBubble !== null && array_key_exists('shouldBubble', $this->updateMap));
    }

    /**
     * If a missing path can't be created, an UnexpectedValueException will be thrown on first write.
     */
    public function setStreamLocation(?string $streamLocation): self
    {
        $this->streamLocation = $streamLocation; $this->updateMap['streamLocation'] = true; return $this;
    }

    /**
     * If a missing path can't be created, an UnexpectedValueException will be thrown on first write.
     */
    public function getStreamLocation(): ?string
    {
        return $this->streamLocation;
    }

    /**
     * If a missing path can't be created, an UnexpectedValueException will be thrown on first write.
     */
    public function requireStreamLocation(): string
    {
        if (static::METADATA['streamLocation']['type'] === 'popo' && $this->streamLocation === null) {
            $popo = static::METADATA['streamLocation']['default'];
            $this->streamLocation = new $popo;
        }

        if ($this->streamLocation === null) {
            throw new UnexpectedValueException('Required value of "streamLocation" has not been set');
        }
        return $this->streamLocation;
    }

    public function hasStreamLocation(): bool
    {
        return $this->streamLocation !== null || ($this->streamLocation !== null && array_key_exists('streamLocation', $this->updateMap));
    }

    /**
     * Try to lock log file before doing any writes.
     */
    public function setUseLocking(?bool $useLocking): self
    {
        $this->useLocking = $useLocking; $this->updateMap['useLocking'] = true; return $this;
    }

    /**
     * Try to lock log file before doing any writes.
     */
    public function useLocking(): ?bool
    {
        return $this->useLocking;
    }

    /**
     * Try to lock log file before doing any writes.
     */
    public function requireUseLocking(): bool
    {
        if (static::METADATA['useLocking']['type'] === 'popo' && $this->useLocking === null) {
            $popo = static::METADATA['useLocking']['default'];
            $this->useLocking = new $popo;
        }

        if ($this->useLocking === null) {
            throw new UnexpectedValueException('Required value of "useLocking" has not been set');
        }
        return $this->useLocking;
    }

    public function hasUseLocking(): bool
    {
        return $this->useLocking !== null || ($this->useLocking !== null && array_key_exists('useLocking', $this->updateMap));
    }

    #[\JetBrains\PhpStorm\ArrayShape(self::SHAPE_PROPERTIES)]
    public function toArray(): array
    {
        $data = [
            'filePermission' => $this->filePermission,
            'logLevel' => $this->logLevel,
            'pluginClass' => $this->pluginClass,
            'pluginFactoryClass' => $this->pluginFactoryClass,
            'shouldBubble' => $this->shouldBubble,
            'streamLocation' => $this->streamLocation,
            'useLocking' => $this->useLocking,
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

    public function requireAll(): self
    {
        $errors = [];

        try {
            $this->requireFilePermission();
        }
        catch (\Throwable $throwable) {
            $errors['filePermission'] = $throwable->getMessage();
        }
        try {
            $this->requireLogLevel();
        }
        catch (\Throwable $throwable) {
            $errors['logLevel'] = $throwable->getMessage();
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
        try {
            $this->requireStreamLocation();
        }
        catch (\Throwable $throwable) {
            $errors['streamLocation'] = $throwable->getMessage();
        }
        try {
            $this->requireUseLocking();
        }
        catch (\Throwable $throwable) {
            $errors['useLocking'] = $throwable->getMessage();
        }

        if (empty($errors) === false) {
            throw new UnexpectedValueException(
                implode("\n", $errors)
            );
        }

        return $this;
    }
}
