<?php

namespace Tests\Units;

use ForceOpener\ForceOpener;
use PHPUnit\Framework\TestCase;
use Tests\Fixtures\ReceiverClass;

class ForceOpenerTest extends TestCase
{
    private ReceiverClass $receiver;

    public function setUp(): void
    {
        $this->receiver = new ReceiverClass();
    }

    public function test_access_public_property(): void
    {
        $forceOpener = new ForceOpener($this->receiver);

        $this->assertEquals('public-string-property', $forceOpener->publicStringProperty);
    }

    public function test_raise_error_if_access_non_existent_property(): void
    {
        $this->expectException(\RuntimeException::class);

        $forceOpener = new ForceOpener($this->receiver);

        // @phpstan-ignore expr.resultUnused
        $forceOpener->nonExistentProperty;
    }
}
