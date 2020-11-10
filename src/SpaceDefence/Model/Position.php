<?php

namespace App\SpaceDefence\Model;

final class Position
{
    private int $x;
    private int $y;
    private ?Vessel $occupiedBy;

    public function __construct(int $x = 0, int $y = 0, Vessel $vessel = null)
    {
        $this->x = $x;
        $this->y = $y;
        $this->occupiedBy = $vessel;
    }

    public static function random(Grid $grid)
    {
        $x = rand(0, $grid->x());
        $y = rand(0, $grid->y());

        return new self($x, $y);
    }

    public function x(): int
    {
        return $this->x;
    }

    public function y(): int
    {
        return $this->y;
    }

    public function occupiedBy(Vessel $vessel)
    {
        $this->occupiedBy = $vessel;
    }

    public function occupant(): ?Vessel
    {
        return $this->occupiedBy;
    }

    public static function neighbourPosition(Position $position, int $distance = 1): self
    {
        return new self($position->x + $distance, $position->y + $distance);
    }
}
