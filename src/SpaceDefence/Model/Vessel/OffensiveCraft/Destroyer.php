<?php

namespace App\SpaceDefence\Model\Vessel\OffensiveCraft;

use App\SpaceDefence\Model\Vessel\OffensiveCraft;

final class Destroyer extends OffensiveCraft
{
    public const TYPE = 'destroyer';

    public function __construct()
    {
        $this->cannons = 12;
        $this->type = self::TYPE;

        parent::__construct();
    }
}
