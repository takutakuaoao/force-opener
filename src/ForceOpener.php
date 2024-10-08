<?php

declare(strict_types=1);

namespace ForceOpener;

class ForceOpener
{
    public function __construct(private object $original)
    {
    }

    public function __get(string $name): mixed
    {
        if (!property_exists($this->original, $name)) {
            $className = get_class($this->original);
            throw new \RuntimeException("Non-existent on $className property called. It was $name.");
        }

        return $this->original->$name;
    }
}
