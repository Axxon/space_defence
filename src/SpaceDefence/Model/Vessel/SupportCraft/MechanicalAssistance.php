<?php

namespace App\SpaceDefence\Model\Vessel\SupportCraft;

use App\SpaceDefence\Model\Vessel\SupportCraft;

final class MechanicalAssistance extends SupportCraft
{
    private const TYPE = 'mechanical_assistance';

    public function __construct()
    {
        $this->type = self::TYPE;
    }
}
