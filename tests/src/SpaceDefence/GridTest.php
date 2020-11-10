<?php

namespace App\Tests\SpaceDefence;

use App\SpaceDefence\FleetComposition;
use App\SpaceDefence\FleetFactory;
use App\SpaceDefence\Model\Grid;
use App\SpaceDefence\Model\Vessel;

use PHPUnit\Framework\TestCase;

class GridTest extends TestCase
{
    public function testRandomMoveOfVesselOnGrid()
    {
        $grid = Grid::createDimension();

        $fleetComposition = new FleetComposition();
        $fleetComposition->cargos = 10;
        $fleetComposition->mechanicalAssistances = 10;
        $fleetComposition->refuelers = 5;

        $fleetComposition->battleships = 10;
        $fleetComposition->cruisers = 10;
        $fleetComposition->destroyers = 5;

        $fleetFactory = new FleetFactory();
        $fleet = $fleetFactory->createFleet($fleetComposition, 'axxon');

        $this->assertEquals(50, $fleet->numberOfVessels());

        $grid->placeVesselsRandom($fleet);

        $this->assertEquals(50, $grid->numbersOfPlacedVessels());
    }

    public function testPairsMovesTogether()
    {
        $grid = Grid::createDimension();

        $fleetComposition = new FleetComposition();
        $fleetComposition->cargos = 10;
        $fleetComposition->mechanicalAssistances = 10;
        $fleetComposition->refuelers = 5;

        $fleetComposition->battleships = 10;
        $fleetComposition->cruisers = 10;
        $fleetComposition->destroyers = 5;

        $fleetFactory = new FleetFactory();
        $fleet = $fleetFactory->createFleet($fleetComposition, 'axxon');

        $this->assertEquals(50, $fleet->numberOfVessels());
        $grid->placeVesselsInPairMode($fleet);
    }

    public function testMoveAPair()
    {
        $grid = Grid::createDimension();

        $fleetComposition = new FleetComposition();
        $fleetComposition->cargos = 10;
        $fleetComposition->mechanicalAssistances = 10;
        $fleetComposition->refuelers = 5;

        $fleetComposition->battleships = 10;
        $fleetComposition->cruisers = 10;
        $fleetComposition->destroyers = 5;

        $fleetFactory = new FleetFactory();
        $fleet = $fleetFactory->createFleet($fleetComposition, 'axxon');

        $this->assertEquals(50, $fleet->numberOfVessels());

        $grid->placeVesselsInPairMode($fleet);

        $selectedVessel = $fleet->getOffensivesOfType(Vessel\OffensiveCraft\Battleship::TYPE)[0];

        $initialPositionOfVessel = $grid->getPositionForVessel($selectedVessel);
        $initialPositionOfVesselPair = $grid->getPositionForVessel($selectedVessel->paired());

        $grid->moveAPair(
            $selectedVessel,
            10,
            2
        );

        $position = $grid->getPositionForVessel($selectedVessel);
        $this->assertEquals($initialPositionOfVessel->x() + 10, $position->x());
        $this->assertEquals($initialPositionOfVessel->y() + 2, $position->y());

        $endPositionForPair = $grid->getPositionForVessel($selectedVessel->paired());
        $this->assertEquals($initialPositionOfVesselPair->x() + 10, $endPositionForPair->x());
        $this->assertEquals($initialPositionOfVesselPair->y() + 2, $endPositionForPair->y());
    }
}
