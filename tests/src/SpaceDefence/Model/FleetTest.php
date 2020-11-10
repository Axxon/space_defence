<?php

namespace App\Tests\SpaceDefence\Model;

use App\SpaceDefence\Model\Character;
use App\SpaceDefence\Model\Fleet;
use App\SpaceDefence\Model\Role;
use App\SpaceDefence\Model\Vessel;
use PHPUnit\Framework\TestCase;

class FleetTest extends TestCase
{
    public function testFleet()
    {
        $commandant = new Character(Role::admiral(), 'axxon');
        $commandShip = new Vessel\CommandShip($commandant);

        $fleet = new Fleet($commandShip);

        $supportCraftCreation = function(Fleet $fleet) {
            for ($i=1; $i <= 5; $i++) {
                $fleet->addSupportCraft(new Vessel\SupportCraft\Cargo());
            }
            for ($i=1; $i <= 5; $i++) {
                $fleet->addSupportCraft(new Vessel\SupportCraft\MechanicalAssistance());
            }
            for ($i=1; $i <= 5; $i++) {
                $fleet->addSupportCraft(new Vessel\SupportCraft\Refueling());
            }
        };

        $offensiveCraftsCreation = function(Fleet $fleet) {
            for ($i=1; $i <= 10; $i++) {
                $fleet->addOffensiveCraft(new Vessel\OffensiveCraft\Battleship());
            }
            for ($i=1; $i <= 10; $i++) {
                $fleet->addOffensiveCraft(new Vessel\OffensiveCraft\Cruiser());
            }
            for ($i=1; $i <= 5; $i++) {
                $fleet->addOffensiveCraft(new Vessel\OffensiveCraft\Destroyer());
            }
        };

        $supportCraftCreation($fleet);
        $offensiveCraftsCreation($fleet);

        $this->assertEquals(40, $fleet->numberOfVessels());
    }
}
