<?php

declare(strict_types=1);

namespace Tests\Fixtures;

class ReceiverClass
{
    public string $publicStringProperty = 'public-string-property';
    public int $publicIntProperty       = 100;
    public bool $publicBoolProperty     = true;
    /** @var array<string> */
    public array $publicArrayProperty      = ['list_1'];
    public ?string $publicNullableProperty = null;

    public object $publicNestObjectProperty;

    public function __construct()
    {
        $this->publicNestObjectProperty = new class () {
            public string $publicProperty = 'nest-object-public-property-value';
        };
    }
}
