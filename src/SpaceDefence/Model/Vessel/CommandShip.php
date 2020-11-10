<?php

namespace App\SpaceDefence\Model\Vessel;

use App\SpaceDefence\Model\Character;
use App\SpaceDefence\Model\Vessel;

final class CommandShip extends Vessel
{
    public Character $commandant;

    public function __construct(Character $commandant)
    {
        $this->commandant = $commandant;
    }
}
