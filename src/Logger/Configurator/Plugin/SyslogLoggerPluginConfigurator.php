<?php

/**
 * Everon logger configuration file. Auto-generated.
 */

declare(strict_types=1);

namespace Everon\Logger\Configurator\Plugin;

use UnexpectedValueException;

class SyslogLoggerPluginConfigurator implements \Everon\Logger\Contract\Configurator\PluginConfiguratorInterface
{
    protected const SHAPE_PROPERTIES = [
        'facility' => 'null|int',
        'ident' => 'null|string',
        'logLevel' => 'null|string',
        'logopts' => 'null|int',
        'pluginClass' => 'null|string',
        'pluginFactoryClass' => 'null|string',
        'shouldBubble' => 'null|bool',
    ];

    protected const METADATA = [
        'facility' => ['type' => 'int', 'default' => \LOG_LOCAL0],
        'ident' => ['type' => 'string', 'default' => null],
        'logLevel' => ['type' => 'string', 'default' => 'debug'],
        'logopts' => ['type' => 'int', 'default' => \LOG_PID],
        'pluginClass' => ['type' => 'string', 'default' => \Everon\Logger\Plugin\Syslog\SyslogLoggerPlugin::class],
        'pluginFactoryClass' => ['type' => 'string', 'default' => null],
        'shouldBubble' => ['type' => 'bool', 'default' => true],
    ];

    /** Either one of the names of the keys in $this->facilities, or a LOG_* facility constant. */
    protected ?int $facility = \LOG_LOCAL0;
    protected ?string $ident = null;

    /** The minimum logging level at which this handler will be triggered */
    protected ?string $logLevel = 'debug';

    /** Option flags for the openlog() call, defaults to LOG_PID. */
    protected ?int $logopts = \LOG_PID;
    protected ?string $pluginClass = \Everon\Logger\Plugin\Syslog\SyslogLoggerPlugin::class;

    /** Defines custom plugin factory to be used to create a plugin */
    protected ?string $pluginFactoryClass = null;

    /** Whether the messages that are handled can bubble up the stack or not */
    protected ?bool $shouldBubble = true;
    protected array $updateMap = [];

    /**
     * Either one of the names of the keys in $this->facilities, or a LOG_* facility constant.
     */
    public function setFacility(?int $facility): self
    {
        $this->facility = $facility; $this->updateMap['facility'] = true; return $this;
    }

    /**
     * Either one of the names of the keys in $this->facilities, or a LOG_* facility constant.
     */
    public function getFacility(): ?int
    {
        return $this->facility;
    }

    /**
     * Either one of the names of the keys in $this->facilities, or a LOG_* facility constant.
     */
    public function requireFacility(): int
    {
        if (static::METADATA['facility']['type'] === 'popo' && $this->facility === null) {
            $popo = static::METADATA['facility']['default'];
            $this->facility = new $popo;
        }

        if ($this->facility === null) {
            throw new UnexpectedValueException('Required value of "facility" has not been set');
        }
        return $this->facility;
    }

    public function hasFacility(): bool
    {
        return $this->facility !== null || ($this->facility !== null && array_key_exists('facility', $this->updateMap));
    }

    public function setIdent(?string $ident): self
    {
        $this->ident = $ident; $this->updateMap['ident'] = true; return $this;
    }

    public function getIdent(): ?string
    {
        return $this->ident;
    }

    public function requireIdent(): string
    {
        if (static::METADATA['ident']['type'] === 'popo' && $this->ident === null) {
            $popo = static::METADATA['ident']['default'];
            $this->ident = new $popo;
        }

        if ($this->ident === null) {
            throw new UnexpectedValueException('Required value of "ident" has not been set');
        }
        return $this->ident;
    }

    public function hasIdent(): bool
    {
        return $this->ident !== null || ($this->ident !== null && array_key_exists('ident', $this->updateMap));
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

    /**
     * Option flags for the openlog() call, defaults to LOG_PID.
     */
    public function setLogopts(?int $logopts): self
    {
        $this->logopts = $logopts; $this->updateMap['logopts'] = true; return $this;
    }

    /**
     * Option flags for the openlog() call, defaults to LOG_PID.
     */
    public function getLogopts(): ?int
    {
        return $this->logopts;
    }

    /**
     * Option flags for the openlog() call, defaults to LOG_PID.
     */
    public function requireLogopts(): int
    {
        if (static::METADATA['logopts']['type'] === 'popo' && $this->logopts === null) {
            $popo = static::METADATA['logopts']['default'];
            $this->logopts = new $popo;
        }

        if ($this->logopts === null) {
            throw new UnexpectedValueException('Required value of "logopts" has not been set');
        }
        return $this->logopts;
    }

    public function hasLogopts(): bool
    {
        return $this->logopts !== null || ($this->logopts !== null && array_key_exists('logopts', $this->updateMap));
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

    #[\JetBrains\PhpStorm\ArrayShape(self::SHAPE_PROPERTIES)]
    public function toArray(): array
    {
        $data = [
            'facility' => $this->facility,
            'ident' => $this->ident,
            'logLevel' => $this->logLevel,
            'logopts' => $this->logopts,
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

    public function requireAll(): self
    {
        $errors = [];

        try {
            $this->requireFacility();
        }
        catch (\Throwable $throwable) {
            $errors['facility'] = $throwable->getMessage();
        }
        try {
            $this->requireIdent();
        }
        catch (\Throwable $throwable) {
            $errors['ident'] = $throwable->getMessage();
        }
        try {
            $this->requireLogLevel();
        }
        catch (\Throwable $throwable) {
            $errors['logLevel'] = $throwable->getMessage();
        }
        try {
            $this->requireLogopts();
        }
        catch (\Throwable $throwable) {
            $errors['logopts'] = $throwable->getMessage();
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
}
