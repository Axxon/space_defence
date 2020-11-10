<?php

namespace App\SpaceDefence\Exception;

class PositionAlreadyAllocated extends \Exception
{
    public $message = 'The given position is already allocated';
}
