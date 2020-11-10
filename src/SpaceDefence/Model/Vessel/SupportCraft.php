<?php

namespace App\SpaceDefence\Model\Vessel;

use App\SpaceDefence\Model\Vessel;
use App\SpaceDefence\Model\Vessel\SupportCraft\MedicalUnit;
use App\SpaceDefence\Model\Vessel\SupportCraft\Order;
use App\SpaceDefence\Model\Vessel\SupportCraft\SupportOrders;

abstract class SupportCraft extends Vessel implements SupportOrders
{
    protected MedicalUnit $medicalUnit;

    public function addMedicalUnit(MedicalUnit $medicalUnit): void
    {
        $this->medicalUnit = $medicalUnit;
    }

    public function execute(Order $order): void
    {
        $order->receiverIs($this);
    }

    public function doThatNow(string $that): void
    {
    }

    public function helpOffensiveCraft(OffensiveCraft $offensiveCraft): void
    {
        $offensiveCraft->isHelpedBy($this);
    }
}
