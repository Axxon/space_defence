<?php

namespace App\SpaceDefence\Model;

use App\SpaceDefence\Exception\FleetMaxVessels;
use App\SpaceDefence\Exception\InvalidComposition;
use App\SpaceDefence\Model\Vessel\CommandShip;
use App\SpaceDefence\Model\Vessel\OffensiveCraft;
use App\SpaceDefence\Model\Vessel\SupportCraft;
use App\SpaceDefence\Exception;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class Fleet
{
    const MAX_VESSELS = 50;

    private CommandShip $commandShip;
    private Collection $offensiveCrafts;
    private Collection $supportCrafts;
    private int $fleetComposition;

    public function getOffensivesOfType(string $type)
    {
        return $this->offensiveCrafts->filter(function(Vessel $element) use ($type) {
            return $element->typeIs() == $type;
        });
    }

    public function getSupportsOfType(string $type)
    {

    }

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

    public function isFleetGroupsEquals(): bool
    {
        return $this->offensiveCrafts->count() == $this->supportCrafts->count();
    }

    public function associateSupportAndAttackForces(): void
    {
        if (false == $this->isFleetGroupsEquals()) {
            throw new InvalidComposition();
        }

        for ($i=0; $i <= $this->offensiveCrafts->count() - 1; $i++) {
            $attackVessel = $this->offensiveCrafts->get($i);
            $supportVessel = $this->supportCrafts->get($i);
            $attackVessel->isHelpedBy($supportVessel);
        }
    }

    public function isAllAttackForcesHaveSupport(): bool
    {
        /** @var OffensiveCraft $offensiveCraft */
        foreach ($this->offensiveCrafts as $offensiveCraft) {
            if (false == $offensiveCraft->hasAnHelper()) {
                return false;
            }

            return true;
        }

        return false;
    }

    private function vessels(): Collection
    {
        return new ArrayCollection(array_merge($this->supportCrafts->toArray(), $this->offensiveCrafts->toArray()));
    }

    public function placeVesselsOnGridRandom(Grid $grid)
    {
        $lastSentPosition = null;
        $generatePosition = function() use ($grid) {
            return Position::random($grid);
        };

        foreach ($this->vessels() as $vessel) {
            $position = $generatePosition();
            while ($grid->isPositionIsNotAlreadyAllocated($position)) {
                $position = $generatePosition();
            }
            $grid->placeVesselAtPosition($position, $vessel);
        }
    }

    public function pairVessels(Grid $grid): void
    {
        if (count($this->vessels()) % 2 != 0) {
            throw new InvalidComposition();
        }

        list($group1, $group2) = array_chunk($this->vessels()->toArray(), ceil(count($this->vessels()) / 2));

        shuffle($group1);
        shuffle($group2);

        $lastSentPosition = null;
        $generatePosition = function() use ($grid) {
            return Position::random($grid);
        };

        $adjacentPosition = function($position) {
            return Position::neighbourPosition($position);
        };

        /** @var Vessel $vessel */
        $i = 0;
        foreach ($group1 as $vessel) {
            $grid->placeVesselAtPosition($position = $generatePosition(), $vessel);
            $vessel->pairWith($group2[$i]);
            $grid->placeVesselAtPosition($adjacentPosition($position), $group2[$i]);
            $i++;
        }
    }
}
