<?php

namespace App\Business;

use App\Business\Model\Game;
use App\Business\Model\GameInterface;
use App\Business\Model\TeamInterface;
use App\Business\Model\WorldCupInterface;
use App\Business\Model\Team;
use App\Business\Model\WorldCup;

class WorldCupBusinessFactory
{

    /**
     * @param String $name
     * @return TeamInterface
     */
    public function createTeam(String $name): TeamInterface
    {
        return new Team($name);
    }

    /**
     * @param TeamInterface $home
     * @param TeamInterface $away
     * @return GameInterface
     */
    public function createGame(TeamInterface $home, TeamInterface $away): GameInterface
    {
        return new Game($home, $away);
    }

    /**
     * @return WorldCupInterface
     */
    public function createWorldCup(): WorldCupInterface
    {
        return new WorldCup();
    }
}