<?php

namespace App\SpaceDefence\Exception;

class FleetMaxVessels extends \Exception
{
    public $message = 'the maximum capacity of vessel on board is reached !';
}
