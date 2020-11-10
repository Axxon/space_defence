<?php

namespace App\SpaceDefence\Model\Vessel\SupportCraft;

final class Order
{
    public function receiverIs(SupportOrders $supportOrders): void
    {
        $supportOrders->doThatNow('ok');
    }
}
