<?php

namespace App\SpaceDefence;

use App\SpaceDefence\Model\Fleet;

final class DefenceStrategy
{
    public function joinSupportWithOffenciveForces(Fleet $fleet): void
    {
        $fleet->associateSupportAndAttackForces();
    }
}
