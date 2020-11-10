<?php

namespace App\SpaceDefence\Model\Vessel;

use App\SpaceDefence\Model\Vessel;
use App\SpaceDefence\Model\Vessel\SupportCraft\MedicalUnit;
use App\SpaceDefence\Model\Vessel\SupportCraft\Order;
use App\SpaceDefence\Model\Vessel\SupportCraft\SupportOrders;

abstract class SupportCraft extends Vessel implements SupportOrders
{
    protected MedicalUnit $medicalUnit;

    public function addMedicalUnit(MedicalUnit $medicalUnit)
    {
        $this->medicalUnit = $medicalUnit;
    }

    public function execute(Order $order)
    {
        $order->receiverIs($this);
    }

    public function doThatNow(string $that)
    {
        echo (string) $that;
    }
}
