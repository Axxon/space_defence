<?php

namespace App\SpaceDefence\Model;

abstract class Vessel
{
    private Vessel $pair;

    protected string $type = 'abstract';

    public function receiveAttack()
    {
        //@todo delete vital points
    }

    public function pairWith(Vessel $vessel): void
    {
        $this->pair = $vessel;
        $vessel->setPair($this);
    }

    private function setPair(Vessel $vessel): void
    {
        $this->pair = $vessel;
    }

    public function typeIs(): string
    {
        return $this->type;
    }

    public function pair(): Vessel
    {
        return $this->pair;
    }
}
