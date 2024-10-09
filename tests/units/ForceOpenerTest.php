<?php

namespace Tests\Units;

use ForceOpener\ForceOpener;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Tests\Fixtures\ReceiverClass;

class ForceOpenerTest extends TestCase
{
    private ReceiverClass $receiver;

    public function setUp(): void
    {
        $this->receiver = new ReceiverClass();
    }

    #[DataProvider('dataProviderPublicProperties')]
    public function test_access_public_property(string $propertyName, mixed $expected): void
    {
        $forceOpener = new ForceOpener($this->receiver);

        $this->assertEquals($expected, $forceOpener->$propertyName);
    }

    /**
     * @return array<string, array<mixed>>
     */
    public static function dataProviderPublicProperties(): array
    {
        return [
            'string' => [
                'propertyName' => 'publicStringProperty',
                'expected'     => 'public-string-property',
            ],
            'int' => [
                'propertyName' => 'publicIntProperty',
                'expected'     => 100,
            ],
            'bool' => [
                'propertyName' => 'publicBoolProperty',
                'expected'     => true,
            ],
            'array' => [
                'propertyName' => 'publicArrayProperty',
                'expected'     => ['list_1'],
            ],
            'null' => [
                'propertyName' => 'publicNullableProperty',
                'expected'     => null,
            ],
        ];
    }

    public function test_access_nest_object_public_property(): void
    {
        $forceOperator = new ForceOpener($this->receiver);

        $nestedObject = (object) $forceOperator->publicNestObjectProperty;

        $this->assertEquals('nest-object-public-property-value', $nestedObject->publicProperty);
    }

    public function test_raise_error_if_access_non_existent_property(): void
    {
        $this->expectException(\RuntimeException::class);

        $forceOpener = new ForceOpener($this->receiver);

        // @phpstan-ignore expr.resultUnused
        $forceOpener->nonExistentProperty;
    }
}
