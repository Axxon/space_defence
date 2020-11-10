<?php

namespace App\SpaceDefence\Model\Vessel;

use App\SpaceDefence\Model\Position;

interface Movable
{
    public function moveTo(Position $position);
}
