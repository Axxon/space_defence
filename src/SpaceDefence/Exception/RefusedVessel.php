<?php

namespace App\SpaceDefence\Exception;

use Exception;

class RefusedVessel extends Exception
{
    public $message = 'invalid vessel';
}
