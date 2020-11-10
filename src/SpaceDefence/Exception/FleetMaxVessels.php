<?php

namespace App\SpaceDefence\Exception;

class FleetMaxVessels extends \Exception
{
    public $message = 'The maximum capacity of vessel on board is reached !';
}
