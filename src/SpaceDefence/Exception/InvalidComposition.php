<?php

namespace App\SpaceDefence\Exception;

class InvalidComposition extends \Exception
{
    public $message = 'Defence and attack groups should have equals members';
}
