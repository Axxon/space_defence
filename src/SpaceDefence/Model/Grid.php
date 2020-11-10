<?php

namespace App\SpaceDefence\Model;

use Doctrine\Common\Collections\ArrayCollection;

final class Grid
{
    private ArrayCollection $positions;

    private int $x;
    private int $y;

    private function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;

        $this->positions = new ArrayCollection();
    }

    public static function createDimension($x = 100, $y = 100)
    {
        return new self($x, $y);
    }

    public function placeVesselsRandom(Fleet $fleet): void
    {
        $fleet->placeVesselsOnGridRandom($this);
    }

    public function placeVesselsInPairMode(Fleet $fleet): void
    {
        $fleet->pairVessels($this);
    }

    public function x(): int
    {
        return $this->x;
    }

    public function y(): int
    {
        return $this->y;
    }

    public function placeVesselAtPosition(Position $position, Vessel $vessel): void
    {
        $position->occupiedBy($vessel);
        $this->positions->add($position);
    }

    public function isPositionIsNotAlreadyAllocated(Position $position): bool
    {
        foreach ($this->positions as $positionCollectionItem) {
            $a = [$position->y(), $position->x()];
            $b = [$positionCollectionItem->y(), $positionCollectionItem->x()];

            if ($a === $b){
                return true;
            }
        }

        return false;
    }

    public function numbersOfPlacedVessels(): int
    {
        return $this->positions->count();
    }

    public function removePosition(Position $position): void
    {
        $this->positions->removeElement($position);
    }

    public function moveAPair(Vessel $vessel, int $x, int $y): void
    {
        $vesselPosition = $this->getPositionForVessel($vessel);

        //@todo add constraint multiple impossible
        $this->placeVesselAtPosition(
            new Position($vesselPosition->x() + $x, $vesselPosition->y() + $y),
            $vessel,
        );

        $this->removePosition($vesselPosition);

        $occupantPairPosition = $this->getPositionForVessel($vessel->pair());

        $this->placeVesselAtPosition(
            new Position($occupantPairPosition->x() + $x, $occupantPairPosition->y() + $y),
            $vessel->pair()
        );

        $this->removePosition($occupantPairPosition);
    }

    public function getPositionForVessel(Vessel $vessel): Position
    {
        return $this->positions->filter(function(Position $position) use ($vessel) {
            return $position->occupant() === $vessel;
        })->first();
    }
}
