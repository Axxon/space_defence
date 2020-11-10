<?php

namespace App\SpaceDefence\Model;

use App\SpaceDefence\Exception\RefusedVessel;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class Character
{
    private Role $role;
    private string $name;
    private Collection $vessels;

    public function __construct(Role $role, string $name, Collection $vessels = null)
    {
        $this->role = $role;
        $this->name = $name;
        $this->vessels = $vessels ?: new ArrayCollection();

        if ($vessels) {
            $this->assertVessels($vessels);
        }
    }

    private function assertVessels(Collection $vessels): void
    {
        $vessels->map(function ($vessel) {
            if (false == ($vessel instanceof Vessel)) {
                throw new RefusedVessel();
            }
        });
    }

    public function addVessel(Vessel $vessel): void
    {
        if ($this->vessels->contains($vessel)) {
            return;
        }

        $this->vessels->add($vessel);
    }
}
