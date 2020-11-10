<?php

namespace App\SpaceDefence\Exception;

use Exception;

class PositionAlreadyAllocated extends Exception
{
    public $message = 'The given position is already allocated';
}
