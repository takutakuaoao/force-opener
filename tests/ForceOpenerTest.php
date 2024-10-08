<?php

namespace Tests;

use ForceOpener\ForceOpener;
use PHPUnit\Framework\TestCase;

class ForceOpenerTest extends TestCase
{
    public function test_access_public_property(): void
    {
        $original = new class () {
            public string $publicProperty = 'test';
        };

        $forceOpener = new ForceOpener($original);

        $this->assertEquals('test', $forceOpener->publicProperty);
    }

    public function test_raise_error_if_access_non_existent_property(): void
    {
        $this->expectException(\RuntimeException::class);

        $original    = new class () {};
        $forceOpener = new ForceOpener($original);

        // @phpstan-ignore expr.resultUnused
        $forceOpener->nonExistentProperty;
    }
}
