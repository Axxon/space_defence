<?php

namespace App\SpaceDefence;

use App\SpaceDefence\Exception\InvalidComposition;
use App\SpaceDefence\Model\Fleet;

class DefenceStrategy
{
    public function joinSupportWithOffenciveForces(Fleet $fleet)
    {
        $fleet->associateSupportAndAttackForces();
    }
}
