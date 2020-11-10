<?php

namespace App\SpaceDefence\Model\Vessel\OffensiveCraft;

use App\SpaceDefence\Model\Vessel\OffensiveCraft;

final class Battleship extends OffensiveCraft
{
    public const TYPE = "battleship";

    public function __construct()
    {
        $this->cannons = 24;
        $this->type = self::TYPE;
        parent::__construct();
    }
}
