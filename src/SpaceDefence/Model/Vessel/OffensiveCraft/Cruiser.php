<?php

namespace App\SpaceDefence\Model\Vessel\OffensiveCraft;

use App\SpaceDefence\Model\Vessel\OffensiveCraft;

final class Cruiser extends OffensiveCraft
{
    public function __construct()
    {
        $this->cannons = 6;

        parent::__construct();
    }
}
