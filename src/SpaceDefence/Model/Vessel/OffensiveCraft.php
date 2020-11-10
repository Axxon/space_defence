<?php

namespace App\SpaceDefence\Model\Vessel;

use App\SpaceDefence\Model\Vessel;

abstract class OffensiveCraft extends Vessel
{
    protected int $cannons;
    private bool $shieldRaised;

    public function __construct()
    {
        parent::__construct();

        $this->shieldRaised = false;
        $this->cannons = 0;
    }

    public function attack(Vessel $target): void
    {
        $this->fireCanons();

        $target->receiveAttack();

    }

    private function fireCanons(): void
    {
        //@todo remove some bullets on the vessel
    }

    public function invertShields(): void
    {
        $this->shieldRaised = !$this->shieldRaised;
    }
}
