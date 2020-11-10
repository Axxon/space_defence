<?php

namespace App\SpaceDefence\Model\Vessel\SupportCraft;

use App\SpaceDefence\Model\Vessel\SupportCraft;

final class Refueling extends SupportCraft
{
    public const TYPE = 'refueling';

    public function __construct()
    {
        $this->type = self::TYPE;
    }
}
