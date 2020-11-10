<?php

namespace App\SpaceDefence\Model;

use App\SpaceDefence\Model\Vessel\Movable;

abstract class Vessel implements Movable
{
    private Position $position;

    public function __construct()
    {
        $this->position = new Position();
    }

    public function moveTo(Position $position)
    {
        $this->position = $position;
    }

    public function receiveAttack()
    {
        //@todo delete vital points
    }
}
