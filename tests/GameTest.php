<?php
declare(strict_types=1);

namespace App\Tests;

use App\Business\Exception\NoPlayException;
use App\Business\Exception\SameTeamException;
use App\Business\WorldCupBusinessFactory;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->factory = new WorldCupBusinessFactory();
    }

    /**
     * @test
     *
     * @return void
     */
    public function sameTeamsName(): void
    {
        $this->expectException(SameTeamException::class);
        $mex = $this->factory->createTeam('Mexico');
        $mex2 = $this->factory->createTeam('Mexico');
        $this->factory->createGame($mex, $mex2);
    }

    /**
     * @test
     *
     * @return void
     */
    public function isInGameNotStartHome(): void
    {
        $this->expectException(NoPlayException::class);
        $mex = $this->factory->createTeam('Mexico');
        $pol = $this->factory->createTeam('Poland');
        $game = $this->factory->createGame($mex, $pol);
        $game->goalHomeTeam();

    }

    /**
     * @test
     *
     * @return void
     */
    public function isInGameNotStartAway(): void
    {
        $this->expectException(NoPlayException::class);
        $mex = $this->factory->createTeam('Mexico');
        $pol = $this->factory->createTeam('Poland');
        $game = $this->factory->createGame($mex, $pol);

        $game->goalAwayTeam();
    }

    /**
     * @test
     *
     * @return void
     */
    public function isInGameFinishHome(): void
    {
        $this->expectException(NoPlayException::class);
        $mex = $this->factory->createTeam('Mexico');
        $pol = $this->factory->createTeam('Poland');
        $game = $this->factory->createGame($mex, $pol);
        $game->setGameStarted();
        $game->setGameFinished();
        $game->goalHomeTeam();
    }

    /**
     * @test
     *
     * @return void
     */
    public function isInGameFinishAway(): void
    {
        $this->expectException(NoPlayException::class);
        $mex = $this->factory->createTeam('Mexico');
        $pol = $this->factory->createTeam('Poland');
        $game = $this->factory->createGame($mex, $pol);
        $game->setGameStarted();
        $game->setGameFinished();

        $game->goalAwayTeam();
    }

    /**
     * @test
     *
     * @return void
     */
    public function isInGameCheckScore(): void
    {
        $mex = $this->factory->createTeam('Mexico');
        $pol = $this->factory->createTeam('Poland');
        $game = $this->factory->createGame($mex, $pol);
        $game->setGameStarted();

        $game->goalAwayTeam();
        $game->goalHomeTeam();

        $this->assertEquals(2,$game->getTotalGoals());

        $game->goalAwayTeam();
        $game->goalHomeTeam();

        $this->assertEquals(4,$game->getTotalGoals());

        $game->goalAwayTeam();

        $this->assertEquals(5,$game->getTotalGoals());
        $game->setGameFinished();
        $this->assertEquals(5,$game->getTotalGoals());
    }
}