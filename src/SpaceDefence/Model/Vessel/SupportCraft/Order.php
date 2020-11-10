<?php

namespace App\SpaceDefence\Model\Vessel\SupportCraft;

final class Order
{
    public function receiverIs(SupportOrders $supportOrders)
    {
        $supportOrders->doThatNow('ok');
    }
}
