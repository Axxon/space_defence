<?php

namespace App\Tests\SpaceDefence;

use App\SpaceDefence\FleetComposition;
use App\SpaceDefence\FleetFactory;
use PHPUnit\Framework\TestCase;

class FleetFactoryTest extends TestCase
{
    public function testCreationOfFleet()
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

        $this->assertEquals(30, $fleet->numberOfVessels());
    }
}
