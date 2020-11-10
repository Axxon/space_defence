<?php

namespace App\SpaceDefence\Model\Vessel\OffensiveCraft;

use App\SpaceDefence\Model\Vessel\OffensiveCraft;

final class Battleship extends OffensiveCraft
{
    public function __construct()
    {
        $this->cannons = 24;

        parent::__construct();
    }
}
