<?php

namespace App\SpaceDefence\Model\Vessel\OffensiveCraft;

use App\SpaceDefence\Model\Vessel\OffensiveCraft;

final class Cruiser extends OffensiveCraft
{
    public const TYPE = 'cruiser';

    public function __construct()
    {
        $this->cannons = 6;
        $this->type = self::TYPE;

        parent::__construct();
    }
}
