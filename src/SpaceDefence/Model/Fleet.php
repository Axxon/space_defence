<?php

namespace App\SpaceDefence\Model;

use App\SpaceDefence\Exception\FleetMaxVessels;
use App\SpaceDefence\Model\Vessel\CommandShip;
use App\SpaceDefence\Model\Vessel\OffensiveCraft;
use App\SpaceDefence\Model\Vessel\SupportCraft;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class Fleet
{
    const MAX_VESSELS = 50;

    private CommandShip $commandShip;
    private Collection $offensiveCrafts;
    private Collection $supportCrafts;
    private int $fleetComposition;

    public function __construct(CommandShip $commandShip)
    {
        $this->commandShip = $commandShip;
        $this->offensiveCrafts = new ArrayCollection();
        $this->supportCrafts = new ArrayCollection();
        $this->fleetComposition = 0;
    }

    public function addOffensiveCraft(OffensiveCraft $offensiveCraft): void
    {
        if ($this->offensiveCrafts->contains($offensiveCraft)) {
            return;
        }

        $this->assertMaxComposition();
        $this->offensiveCrafts->add($offensiveCraft);
        $this->fleetComposition++;
    }

    public function addSupportCraft(SupportCraft $supportCraft): void
    {
        if ($this->supportCrafts->contains($supportCraft)) {
            return;
        }

        $this->assertMaxComposition();
        $this->supportCrafts->add($supportCraft);
        $this->fleetComposition++;
    }

    private function assertMaxComposition()
    {
        if ($this->fleetComposition == self::MAX_VESSELS) {
            throw new FleetMaxVessels();
        }
    }

    public function numberOfVessels(): int
    {
        return $this->fleetComposition;
    }

    public function defence()
    {

    }
}
