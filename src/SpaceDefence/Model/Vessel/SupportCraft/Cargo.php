<?php

namespace App\SpaceDefence\Model\Vessel\SupportCraft;

use App\SpaceDefence\Model\Vessel\SupportCraft;

final class Cargo extends SupportCraft
{
    public const TYPE = 'cargo';

    public function __construct()
    {
        $this->type = self::TYPE;
    }
}
