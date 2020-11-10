<?php

namespace App\SpaceDefence\Model\Vessel;

use App\SpaceDefence\Model\Vessel;

abstract class OffensiveCraft extends Vessel
{
    protected int $cannons;
    private bool $shieldRaised;
    private ?SupportCraft $helper;

    public function __construct()
    {
        $this->shieldRaised = false;
        $this->cannons = 0;
        $this->helper = null;
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

    public function isHelpedBy(SupportCraft $supportCraft)
    {
        $this->helper = $supportCraft;
    }

    public function hasAnHelper(): bool
    {
        return (null !== $this->helper);
    }
}
