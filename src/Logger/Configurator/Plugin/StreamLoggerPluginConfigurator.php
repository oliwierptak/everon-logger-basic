<?php declare(strict_types = 1);

namespace Everon\Logger\Configurator\Plugin;

use Everon\Logger\Configurator\AbstractPluginConfigurator;
use Everon\Logger\Plugin\Stream\StreamLoggerPlugin;
use InvalidArgumentException;
use UnexpectedValueException;
use function array_key_exists;
use function ctype_upper;
use function is_array;
use function is_object;
use function method_exists;
use function sprintf;
use function strtolower;
use function trim;

/**
 * Code generated by POPO generator, do not edit.
 * https://packagist.org/packages/popo/generator
 */
class StreamLoggerPluginConfigurator extends AbstractPluginConfigurator
{
    protected array $data = [
        'pluginClass' => StreamLoggerPlugin::class,
        'pluginFactoryClass' => null,
        'logLevel' => 'debug',
        'shouldBubble' => true,
        'streamLocation' => null,
        'filePermission' => null,
        'useLocking' => false,
    ];

    protected array $default = [
        'pluginClass' => StreamLoggerPlugin::class,
        'pluginFactoryClass' => null,
        'logLevel' => 'debug',
        'shouldBubble' => true,
        'streamLocation' => null,
        'filePermission' => null,
        'useLocking' => false,
    ];

    protected array $propertyMapping = [
        'pluginClass' => 'string',
        'pluginFactoryClass' => 'string',
        'logLevel' => 'string',
        'shouldBubble' => 'bool',
        'streamLocation' => 'string',
        'filePermission' => 'int',
        'useLocking' => 'bool',
    ];

    protected array $collectionItems = [
    ];

    protected array $updateMap = [];

    public function toArray(): array
    {
        $data = [];

        foreach ($this->propertyMapping as $key => $type) {
            if (!array_key_exists($key, $data)) {
                $data[$key] = $this->default[$key] ?? null;
            }
            $value = $this->data[$key];

            if ($this->isCollectionItem($key) && is_array($value)) {
                foreach ($value as $popo) {
                    if (is_object($popo) && method_exists($popo, 'toArray')) {
                        $data[$key][] = $popo->toArray();
                    }
                }

                continue;
            }

            if (is_object($value) && method_exists($value, 'toArray')) {
                $data[$key] = $value->toArray();
                continue;
            }

            $data[$key] = $value;
        }

        return $data;
    }

    protected function isCollectionItem(string $key): bool
    {
        return array_key_exists($key, $this->collectionItems);
    }

    public function fromArray(array $data): StreamLoggerPluginConfigurator
    {
        foreach ($this->propertyMapping as $key => $type) {
            $result[$key] = $this->default[$key] ?? null;

            if ($this->typeIsObject($type)) {
                $popo = new $this->propertyMapping[$key];
                if (method_exists($popo, 'fromArray')) {
                    $popoData = $data[$key] ?? $this->default[$key] ?? [];
                    $popo->fromArray($popoData);
                }
                $result[$key] = $popo;

                continue;
            }

            if (array_key_exists($key, $data)) {
                if ($this->isCollectionItem($key)) {
                    foreach ($data[$key] as $popoData) {
                        $popo = new $this->collectionItems[$key]();
                        if (method_exists($popo, 'fromArray')) {
                            $popo->fromArray($popoData);
                        }
                        $result[$key][] = $popo;
                    }
                }
                else {
                    $result[$key] = $data[$key];
                }
            }
        }

        $this->data = $result;

        foreach ($data as $key => $value) {
            if (!array_key_exists($key, $result)) {
                continue;
            }

            $type = $this->propertyMapping[$key] ?? null;
            if ($type !== null) {
                $value = $this->typecastValue($type, $result[$key]);
                $this->popoSetValue($key, $value);
            }
        }

        return $this;
    }

    /**
     * @param string $type
     * @param mixed $value
     *
     * @return mixed
     */
    protected function typecastValue(string $type, $value)
    {
        if ($value === null) {
            return $value;
        }

        switch ($type) {
            case 'int':
                $value = (int) $value;
                break;
            case 'string':
                $value = (string) $value;
                break;
            case 'bool':
                $value = (bool) $value;
                break;
            case 'array':
                $value = (array) $value;
                break;
        }

        return $value;
    }

    public function isNew(): bool
    {
        return empty($this->updateMap);
    }

    /**
     * @return string|null
     */
    public function getPluginClass(): ?string
    {
        return $this->popoGetValue('pluginClass');
    }

    /**
     * @param string|null $pluginClass
     *
     * @return StreamLoggerPluginConfigurator
     */
    public function setPluginClass(?string $pluginClass): StreamLoggerPluginConfigurator
    {
        $this->popoSetValue('pluginClass', $pluginClass);

        return $this;
    }

    /**
     * Throws exception if value is null.
     *
     * @return string
     * @throws \UnexpectedValueException
     *
     */
    public function requirePluginClass(): string
    {
        $this->assertPropertyValue('pluginClass');

        return (string) $this->popoGetValue('pluginClass');
    }

    /**
     * @param string $property
     *
     * @return void
     * @throws UnexpectedValueException
     */
    protected function assertPropertyValue(string $property): void
    {
        if (!isset($this->data[$property])) {
            throw new UnexpectedValueException(sprintf(
                'Required value of "%s" has not been set',
                $property
            ));
        }
    }

    /**
     * Returns true if value was set to any value, ignores defaults.
     *
     * @return bool
     */
    public function hasPluginClass(): bool
    {
        return $this->updateMap['pluginClass'] ?? false;
    }

    /**
     * @return string|null Defines custom plugin factory to be used to create a plugin
     */
    public function getPluginFactoryClass(): ?string
    {
        return $this->popoGetValue('pluginFactoryClass');
    }

    /**
     * @param string|null $pluginFactoryClass Defines custom plugin factory to be used to create a plugin
     *
     * @return StreamLoggerPluginConfigurator
     */
    public function setPluginFactoryClass(?string $pluginFactoryClass): StreamLoggerPluginConfigurator
    {
        $this->popoSetValue('pluginFactoryClass', $pluginFactoryClass);

        return $this;
    }

    /**
     * Throws exception if value is null.
     *
     * @return string Defines custom plugin factory to be used to create a plugin
     * @throws \UnexpectedValueException
     *
     */
    public function requirePluginFactoryClass(): string
    {
        $this->assertPropertyValue('pluginFactoryClass');

        return (string) $this->popoGetValue('pluginFactoryClass');
    }

    /**
     * Returns true if value was set to any value, ignores defaults.
     *
     * @return bool
     */
    public function hasPluginFactoryClass(): bool
    {
        return $this->updateMap['pluginFactoryClass'] ?? false;
    }

    /**
     * @return string|null The minimum logging level at which this handler will be triggered
     */
    public function getLogLevel(): ?string
    {
        return $this->popoGetValue('logLevel');
    }

    /**
     * @param string|null $logLevel The minimum logging level at which this handler will be triggered
     *
     * @return StreamLoggerPluginConfigurator
     */
    public function setLogLevel(?string $logLevel): StreamLoggerPluginConfigurator
    {
        $this->popoSetValue('logLevel', $logLevel);

        return $this;
    }

    /**
     * Throws exception if value is null.
     *
     * @return string The minimum logging level at which this handler will be triggered
     * @throws \UnexpectedValueException
     *
     */
    public function requireLogLevel(): string
    {
        $this->assertPropertyValue('logLevel');

        return (string) $this->popoGetValue('logLevel');
    }

    /**
     * Returns true if value was set to any value, ignores defaults.
     *
     * @return bool
     */
    public function hasLogLevel(): bool
    {
        return $this->updateMap['logLevel'] ?? false;
    }

    /**
     * @return boolean|null Whether the messages that are handled can bubble up the stack or not
     */
    public function shouldBubble(): ?bool
    {
        return $this->popoGetValue('shouldBubble');
    }

    /**
     * @param boolean|null $shouldBubble Whether the messages that are handled can bubble up the stack or not
     *
     * @return StreamLoggerPluginConfigurator
     */
    public function setShouldBubble(?bool $shouldBubble): StreamLoggerPluginConfigurator
    {
        $this->popoSetValue('shouldBubble', $shouldBubble);

        return $this;
    }

    /**
     * Throws exception if value is null.
     *
     * @return boolean Whether the messages that are handled can bubble up the stack or not
     * @throws \UnexpectedValueException
     *
     */
    public function requireShouldBubble(): bool
    {
        $this->assertPropertyValue('shouldBubble');

        return (bool) $this->popoGetValue('shouldBubble');
    }

    /**
     * Returns true if value was set to any value, ignores defaults.
     *
     * @return bool
     */
    public function hasShouldBubble(): bool
    {
        return $this->updateMap['shouldBubble'] ?? false;
    }

    /**
     * @return string|null If a missing path can't be created, an UnexpectedValueException will be thrown on first write
     */
    public function getStreamLocation(): ?string
    {
        return $this->popoGetValue('streamLocation');
    }

    /**
     * @param string|null $streamLocation If a missing path can't be created, an UnexpectedValueException will be thrown on first write
     *
     * @return StreamLoggerPluginConfigurator
     */
    public function setStreamLocation(?string $streamLocation): StreamLoggerPluginConfigurator
    {
        $this->popoSetValue('streamLocation', $streamLocation);

        return $this;
    }

    /**
     * Throws exception if value is null.
     *
     * @return string If a missing path can't be created, an UnexpectedValueException will be thrown on first write
     * @throws \UnexpectedValueException
     *
     */
    public function requireStreamLocation(): string
    {
        $this->assertPropertyValue('streamLocation');

        return (string) $this->popoGetValue('streamLocation');
    }

    /**
     * Returns true if value was set to any value, ignores defaults.
     *
     * @return bool
     */
    public function hasStreamLocation(): bool
    {
        return $this->updateMap['streamLocation'] ?? false;
    }

    /**
     * @return integer|null Optional file permissions (default (0644) are only for owner read/write)
     */
    public function getFilePermission(): ?int
    {
        return $this->popoGetValue('filePermission');
    }

    /**
     * @param integer|null $filePermission Optional file permissions (default (0644) are only for owner read/write)
     *
     * @return StreamLoggerPluginConfigurator
     */
    public function setFilePermission(?int $filePermission): StreamLoggerPluginConfigurator
    {
        $this->popoSetValue('filePermission', $filePermission);

        return $this;
    }

    /**
     * Throws exception if value is null.
     *
     * @return integer Optional file permissions (default (0644) are only for owner read/write)
     * @throws \UnexpectedValueException
     *
     */
    public function requireFilePermission(): int
    {
        $this->assertPropertyValue('filePermission');

        return (int) $this->popoGetValue('filePermission');
    }

    /**
     * Returns true if value was set to any value, ignores defaults.
     *
     * @return bool
     */
    public function hasFilePermission(): bool
    {
        return $this->updateMap['filePermission'] ?? false;
    }

    /**
     * @return boolean|null Try to lock log file before doing any writes
     */
    public function useLocking(): ?bool
    {
        return $this->popoGetValue('useLocking');
    }

    /**
     * @param boolean|null $useLocking Try to lock log file before doing any writes
     *
     * @return StreamLoggerPluginConfigurator
     */
    public function setUseLocking(?bool $useLocking): StreamLoggerPluginConfigurator
    {
        $this->popoSetValue('useLocking', $useLocking);

        return $this;
    }

    /**
     * Throws exception if value is null.
     *
     * @return boolean Try to lock log file before doing any writes
     * @throws \UnexpectedValueException
     *
     */
    public function requireUseLocking(): bool
    {
        $this->assertPropertyValue('useLocking');

        return (bool) $this->popoGetValue('useLocking');
    }

    /**
     * Returns true if value was set to any value, ignores defaults.
     *
     * @return bool
     */
    public function hasUseLocking(): bool
    {
        return $this->updateMap['useLocking'] ?? false;
    }

    /**
     * @param string $propertyName
     * @param mixed $value
     *
     * @return void
     * @throws \InvalidArgumentException
     */
    protected function addCollectionItem(string $propertyName, $value): void
    {
        $type = trim(strtolower($this->propertyMapping[$propertyName]));
        $collection = $this->popoGetValue($propertyName) ?? [];

        if (!is_array($collection) || $type !== 'array') {
            throw new InvalidArgumentException('Cannot add item to non array type: ' . $propertyName);
        }

        $collection[] = $value;

        $this->popoSetValue($propertyName, $collection);
    }

    /**
     * @param string $property
     *
     * @return mixed|null
     */
    protected function popoGetValue(string $property)
    {
        if (!isset($this->data[$property])) {
            if ($this->typeIsObject($this->propertyMapping[$property])) {
                $popo = new $this->propertyMapping[$property];
                $this->data[$property] = $popo;
            }
            else {
                return null;
            }
        }

        return $this->data[$property];
    }

    protected function typeIsObject(string $value): bool
    {
        return $value[0] === '\\' && ctype_upper($value[1]);
    }

    /**
     * @param string $property
     * @param mixed $value
     *
     * @return void
     */
    protected function popoSetValue(string $property, $value): void
    {
        $this->data[$property] = $value;

        $this->updateMap[$property] = true;
    }
}
