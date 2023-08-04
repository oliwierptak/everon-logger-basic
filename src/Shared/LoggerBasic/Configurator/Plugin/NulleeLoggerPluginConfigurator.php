<?php

/**
 * @SuppressWarnings(PHPMD)
 * @phpcs:ignoreFile
 * Everon logger configuration file. Auto-generated.
 */

declare(strict_types=1);

namespace Everon\Shared\LoggerBasic\Configurator\Plugin;

use DateTime;
use DateTimeZone;
use Throwable;
use UnexpectedValueException;

use function array_filter;
use function array_key_exists;
use function array_keys;
use function array_replace_recursive;
use function in_array;
use function sort;

use const ARRAY_FILTER_USE_KEY;
use const SORT_STRING;

class NulleeLoggerPluginConfigurator implements \Everon\Logger\Contract\Configurator\PluginConfiguratorInterface
{
    use \Everon\Shared\Logger\Configurator\MonologLevelConfiguratorTrait;

    public const PLUGIN_CLASS = 'pluginClass';
    public const PLUGIN_FACTORY_CLASS = 'pluginFactoryClass';
    public const SHOULD_BUBBLE = 'shouldBubble';

    protected const METADATA = [
        'pluginClass' => [
            'type' => 'string',
            'default' => \Everon\LoggerBasic\Plugin\Nullee\NulleeLoggerPlugin::class,
            'mappingPolicy' => [],
            'mappingPolicyValue' => 'pluginClass',
        ],
        'pluginFactoryClass' => [
            'type' => 'string',
            'default' => null,
            'mappingPolicy' => [],
            'mappingPolicyValue' => 'pluginFactoryClass',
        ],
        'shouldBubble' => [
            'type' => 'bool',
            'default' => true,
            'mappingPolicy' => [],
            'mappingPolicyValue' => 'shouldBubble',
        ],
    ];

    protected array $updateMap = [];
    protected ?string $pluginClass = \Everon\LoggerBasic\Plugin\Nullee\NulleeLoggerPlugin::class;

    /** Defines custom plugin factory to be used to create a plugin */
    protected ?string $pluginFactoryClass = null;

    /** Whether the messages that are handled can bubble up the stack or not */
    protected bool $shouldBubble = true;

    protected function setupDateTimeProperty($propertyName): void
    {
        if (self::METADATA[$propertyName]['type'] === 'datetime' && $this->$propertyName === null) {
            $value = self::METADATA[$propertyName]['default'] ?: 'now';
            $datetime = new DateTime($value);
            $timezone = self::METADATA[$propertyName]['timezone'] ?? null;
            if ($timezone !== null) {
                $timezone = new DateTimeZone($timezone);
                $datetime = new DateTime($value, $timezone);
            }
            $this->$propertyName = $datetime;
        }
    }

    public function isNew(): bool
    {
        return empty($this->updateMap) === true;
    }

    public function listModifiedProperties(): array
    {
        $sorted = array_keys($this->updateMap);
        sort($sorted, SORT_STRING);
        return $sorted;
    }

    public function modifiedToArray(): array
    {
        $data = $this->toArray();
        $modifiedProperties = $this->listModifiedProperties();

        return array_filter($data, function ($key) use ($modifiedProperties) {
            return in_array($key, $modifiedProperties);
        }, ARRAY_FILTER_USE_KEY);
    }

    protected function setupPopoProperty($propertyName): void
    {
        if (self::METADATA[$propertyName]['type'] === 'popo' && $this->$propertyName === null) {
            $popo = self::METADATA[$propertyName]['default'];
            $this->$propertyName = new $popo;
        }
    }

    public function requireAll(): self
    {
        $errors = [];

        try {
            $this->requirePluginClass();
        }
        catch (Throwable $throwable) {
            $errors['pluginClass'] = $throwable->getMessage();
        }
        try {
            $this->requirePluginFactoryClass();
        }
        catch (Throwable $throwable) {
            $errors['pluginFactoryClass'] = $throwable->getMessage();
        }
        try {
            $this->requireShouldBubble();
        }
        catch (Throwable $throwable) {
            $errors['shouldBubble'] = $throwable->getMessage();
        }

        if (empty($errors) === false) {
            throw new UnexpectedValueException(
                implode("\n", $errors)
            );
        }

        return $this;
    }

    public function fromArray(array $data): self
    {
        $metadata = [
            'pluginClass' => 'pluginClass',
            'pluginFactoryClass' => 'pluginFactoryClass',
            'shouldBubble' => 'shouldBubble',
        ];



        foreach ($metadata as $name => $mappedName) {
            $meta = self::METADATA[$name];
            $value = $data[$mappedName] ?? $this->$name ?? null;
            $popoValue = $meta['default'];

            if ($popoValue !== null && $meta['type'] === 'popo') {
                $popo = new $popoValue;

                if (is_array($value)) {
                    $popo->fromArray($value);
                }

                $value = $popo;
            }

            if ($meta['type'] === 'datetime') {
                if (($value instanceof DateTime) === false) {
                    $datetime = new DateTime($data[$name] ?? $meta['default'] ?: 'now');
                    $timezone = $meta['timezone'] ?? null;
                    if ($timezone !== null) {
                        $timezone = new DateTimeZone($timezone);
                        $datetime = new DateTime($data[$name] ?? self::METADATA[$name]['default'] ?: 'now', $timezone);
                    }
                    $value = $datetime;
                }
            }

            if ($meta['type'] === 'array' && isset($meta['itemIsPopo']) && $meta['itemIsPopo']) {
                $className = $meta['itemType'];

                $valueCollection = [];
                foreach ($value as $popoKey => $popoValue) {
                    $popo = new $className;
                    $popo->fromArray($popoValue);

                    $valueCollection[] = $popo;
                }

                $value = $valueCollection;
            }

            $this->$name = $value;
            if (array_key_exists($mappedName, $data)) {
                $this->updateMap[$name] = true;
            }
        }

        return $this;
    }

    public function fromMappedArray(array $data, ...$mappings): self
    {
        $result = [];
        foreach (self::METADATA as $name => $propertyMetadata) {
            $mappingPolicyValue = $propertyMetadata['mappingPolicyValue'];
            $inputKey = $this->mapKeyName($mappings, $mappingPolicyValue);
            $value = $data[$inputKey] ?? null;

            if (self::METADATA[$name]['type'] === 'popo') {
                $popo = self::METADATA[$name]['default'];
                $value = $this->$name !== null
                    ? $this->$name->fromMappedArray($value ?? [], ...$mappings)
                    : (new $popo)->fromMappedArray($value ?? [], ...$mappings);
                $value = $value->toArray();
            }

            $result[$mappingPolicyValue] = $value;
        }

        $this->fromArray($result);

        return $this;
    }

    public function toArray(): array
    {
        $metadata = [
            'pluginClass' => 'pluginClass',
            'pluginFactoryClass' => 'pluginFactoryClass',
            'shouldBubble' => 'shouldBubble',
        ];

        $data = [];

        foreach ($metadata as $name => $mappedName) {
            $value = $this->$name;

            if (self::METADATA[$name]['type'] === 'popo') {
                $popo = self::METADATA[$name]['default'];
                $value = $this->$name !== null ? $this->$name->toArray() : (new $popo)->toArray();
            }

            if (self::METADATA[$name]['type'] === 'datetime') {
                if (($value instanceof DateTime) === false) {
                    $datetime = new DateTime(self::METADATA[$name]['default'] ?: 'now');
                    $timezone = self::METADATA[$name]['timezone'] ?? null;
                    if ($timezone !== null) {
                        $timezone = new DateTimeZone($timezone);
                        $datetime = new DateTime($this->$name ?? self::METADATA[$name]['default'] ?: 'now', $timezone);
                    }
                    $value = $datetime;
                }

                $value = $value->format(self::METADATA[$name]['format']);
            }

            if (self::METADATA[$name]['type'] === 'array' && isset(self::METADATA[$name]['itemIsPopo']) && self::METADATA[$name]['itemIsPopo']) {
                $valueCollection = [];
                foreach ($value as $popo) {
                    $valueCollection[] = $popo->toArray();
                }

                $value = $valueCollection;
            }

            $data[$mappedName] = $value;
        }



        return $data;
    }

    public function toMappedArray(...$mappings): array
    {
        return $this->map($this->toArray(), $mappings);
    }

    protected function map(array $data, array $mappings): array
    {
        $result = [];
        foreach (self::METADATA as $name => $propertyMetadata) {
            $value = $data[$propertyMetadata['mappingPolicyValue']];

            if (self::METADATA[$name]['type'] === 'popo') {
                $popo = self::METADATA[$name]['default'];
                $value = $this->$name !== null ? $this->$name->toMappedArray(...$mappings) : (new $popo)->toMappedArray(...$mappings);
            }

            $key = $this->mapKeyName($mappings, $propertyMetadata['mappingPolicyValue']);
            $result[$key] = $value;
        }

        return $result;
    }

    protected function mapKeyName(array $mappings, string $key): string
    {
        static $mappingPolicy = [];

        if (empty($mappingPolicy)) {

            $mappingPolicy['none'] =
                static function (string $key): string {
                    return $key;
                };

            $mappingPolicy['lower'] =
                static function (string $key): string {
                    return mb_strtolower($key);
                };

            $mappingPolicy['upper'] =
                static function (string $key): string {
                    return mb_strtoupper($key);
                };

            $mappingPolicy['snake-to-camel'] =
                static function (string $key): string {
                    $stringTokens = explode('_', mb_strtolower($key));
                $camelizedString = array_shift($stringTokens);
                foreach ($stringTokens as $token) {
                    $camelizedString .= ucfirst($token);
                }

                return $camelizedString;
                };

            $mappingPolicy['camel-to-snake'] =
                static function (string $key): string {
                    $camelizedStringTokens = preg_split('/(?<=[^A-Z])(?=[A-Z])/', $key);
                if ($camelizedStringTokens !== false && count($camelizedStringTokens) > 0) {
                    $key = mb_strtolower(implode('_', $camelizedStringTokens));
                }

                return $key;
                };

        }

        foreach ($mappings as $mappingIndex => $mappingType) {
            if (!array_key_exists($mappingType, $mappingPolicy)) {
                continue;
            }

            $key = $mappingPolicy[$mappingType]($key);
        }

        return $key;
    }

    public function toArrayLower(): array
    {
        return $this->toMappedArray('lower');
    }

    public function toArrayUpper(): array
    {
        return $this->toMappedArray('upper');
    }

    public function toArraySnakeToCamel(): array
    {
        return $this->toMappedArray('snake-to-camel');
    }

    public function toArrayCamelToSnake(): array
    {
        return $this->toMappedArray('camel-to-snake');
    }

    public function getPluginClass(): ?string
    {
        return $this->pluginClass;
    }

    public function hasPluginClass(): bool
    {
        return $this->pluginClass !== null;
    }

    public function requirePluginClass(): string
    {
        $this->setupPopoProperty('pluginClass');
        $this->setupDateTimeProperty('pluginClass');

        if ($this->pluginClass === null) {
            throw new UnexpectedValueException('Required value of "pluginClass" has not been set');
        }
        return $this->pluginClass;
    }

    public function setPluginClass(?string $pluginClass): self
    {
        $this->pluginClass = $pluginClass; $this->updateMap['pluginClass'] = true; return $this;
    }

    /**
     * Defines custom plugin factory to be used to create a plugin
     */
    public function getPluginFactoryClass(): ?string
    {
        return $this->pluginFactoryClass;
    }

    public function hasPluginFactoryClass(): bool
    {
        return $this->pluginFactoryClass !== null;
    }

    /**
     * Defines custom plugin factory to be used to create a plugin
     */
    public function requirePluginFactoryClass(): string
    {
        $this->setupPopoProperty('pluginFactoryClass');
        $this->setupDateTimeProperty('pluginFactoryClass');

        if ($this->pluginFactoryClass === null) {
            throw new UnexpectedValueException('Required value of "pluginFactoryClass" has not been set');
        }
        return $this->pluginFactoryClass;
    }

    /**
     * Defines custom plugin factory to be used to create a plugin
     */
    public function setPluginFactoryClass(?string $pluginFactoryClass): self
    {
        $this->pluginFactoryClass = $pluginFactoryClass; $this->updateMap['pluginFactoryClass'] = true; return $this;
    }

    /**
     * Whether the messages that are handled can bubble up the stack or not
     */
    public function shouldBubble(): ?bool
    {
        return $this->shouldBubble;
    }

    public function hasShouldBubble(): bool
    {
        return $this->shouldBubble !== null;
    }

    /**
     * Whether the messages that are handled can bubble up the stack or not
     */
    public function requireShouldBubble(): bool
    {
        $this->setupPopoProperty('shouldBubble');
        $this->setupDateTimeProperty('shouldBubble');

        if ($this->shouldBubble === null) {
            throw new UnexpectedValueException('Required value of "shouldBubble" has not been set');
        }
        return $this->shouldBubble;
    }

    /**
     * Whether the messages that are handled can bubble up the stack or not
     */
    public function setShouldBubble(bool $shouldBubble): self
    {
        $this->shouldBubble = $shouldBubble; $this->updateMap['shouldBubble'] = true; return $this;
    }
}
