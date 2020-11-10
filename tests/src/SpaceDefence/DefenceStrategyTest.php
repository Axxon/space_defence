<?php

namespace App\Tests\SpaceDefence;

use App\SpaceDefence\FleetComposition;
use App\SpaceDefence\FleetFactory;
use App\SpaceDefence\Exception\InvalidComposition;

use PHPUnit\Framework\TestCase;

class DefenceStrategyTest extends TestCase
{
    public function testJoinForces()
    {
        $fleetComposition = new FleetComposition();
        $fleetComposition->cargos = 5;
        $fleetComposition->mechanicalAssistances = 5;
        $fleetComposition->refuelers = 5;
        $fleetComposition->battleships = 5;
        $fleetComposition->cruisers = 5;
        $fleetComposition->destroyers = 5;

        $fleetFactory = new FleetFactory();
        $fleet = $fleetFactory->createFleet($fleetComposition, 'axxon');

        $fleet->associateSupportAndAttackForces();

        $this->assertTrue($fleet->isAllAttackForcesHaveSupport());
    }

    public function testNotEqualFleetComposition()
    {
        $this->expectException(InvalidComposition::class);

        $fleetComposition = new FleetComposition();
        $fleetComposition->cargos = 5;
        $fleetComposition->mechanicalAssistances = 5;
        $fleetComposition->refuelers = 5;
        $fleetComposition->battleships = 1;
        $fleetComposition->cruisers = 5;
        $fleetComposition->destroyers = 5;

        $fleetFactory = new FleetFactory();
        $fleet = $fleetFactory->createFleet($fleetComposition, 'axxon');

        $fleet->associateSupportAndAttackForces();
    }
}
