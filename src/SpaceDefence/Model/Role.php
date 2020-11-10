<?php

namespace App\SpaceDefence\Model;

final class Role
{
    public const ADMIRAL = 'admiral';

    private string $name;

    private function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function admiral(): self
    {
        return new self(self::ADMIRAL);
    }
}
