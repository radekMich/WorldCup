<?php
declare(strict_types=1);

namespace App\Tests;

use App\Business\Model\Game;
use App\Business\Model\WorldCup;
use App\Business\WorldCupBusinessFactory;
use PHPUnit\Framework\TestCase;

class WorldCupTest extends TestCase
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
    public function addGames(): void
    {
        $worldCup = $this->factory->createWorldCup();
        $mex = $this->factory->createTeam('Mexico');
        $ger = $this->factory->createTeam('Germany');
        $game1 = $this->factory->createGame($mex, $ger);

        $spa = $this->factory->createTeam('Spain');
        $port = $this->factory->createTeam('Portugal');
        $game2 = $this->factory->createGame($spa, $port);

        $ita = $this->factory->createTeam('Italy');
        $fra = $this->factory->createTeam('France');
        $game3 = $this->factory->createGame($ita, $fra);
        $worldCup->addGame($game1);
        $this->assertCount(1, $worldCup->getTournament());
        $worldCup->addGame($game2);
        $worldCup->addGame($game3);
        $this->assertCount(3, $worldCup->getTournament());
    }


    /**
     * @test
     *
     * @return void
     */
    public function sortFinalResult(): void
    {
        $worldCup = $this->factory->createWorldCup();
        $mex = $this->factory->createTeam('Mexico');
        $ger = $this->factory->createTeam('Germany');
        $game1 = $this->factory->createGame($mex, $ger);

        $spa = $this->factory->createTeam('Spain');
        $port = $this->factory->createTeam('Portugal');
        $game2 = $this->factory->createGame($spa, $port);

        $ita = $this->factory->createTeam('Italy');
        $fra = $this->factory->createTeam('France');
        $game3 = $this->factory->createGame($ita, $fra);
        $worldCup->addGame($game1);
        $worldCup->addGame($game2);
        $worldCup->addGame($game3);

        $worldCup->startGame(0);
        $worldCup->startGame(1);
        $worldCup->startGame(2);

        $worldCup->goalAwayTeam(0);
        $worldCup->goalAwayTeam(0);
        $worldCup->goalHomeTeam(0);

        $worldCup->finishGame(0);

        $worldCup->goalAwayTeam(1);
        $worldCup->goalAwayTeam(1);
        $worldCup->goalHomeTeam(1);
        $worldCup->goalHomeTeam(1);

        $worldCup->finishGame(1);

        $worldCup->goalAwayTeam(2);
        $worldCup->goalAwayTeam(2);
        $worldCup->goalHomeTeam(2);
        $worldCup->goalHomeTeam(2);

        $worldCup->finishGame(2);

        $result = $worldCup->getFinalResult();

        $this->assertCount(3,$result);

        /**
         * @var Game $game
         */
        $game = array_shift($result);

        $this->assertEquals(4,$game->getTotalGoals());
        $this->assertEquals('Italy',$game->getHomeTeamName());
        $this->assertEquals('France',$game->getAwayTeamName());
        $this->assertEquals(2,$game->getHomeTeamScore());
        $this->assertEquals(2,$game->getAwayTeamScore());

        /**
         * @var Game $game
         */
        $game = array_shift($result);

        $this->assertEquals(4,$game->getTotalGoals());
        $this->assertEquals('Spain',$game->getHomeTeamName());
        $this->assertEquals('Portugal',$game->getAwayTeamName());
        $this->assertEquals(2,$game->getHomeTeamScore());
        $this->assertEquals(2,$game->getAwayTeamScore());

        /**
         * @var Game $game
         */
        $game = array_shift($result);

        $this->assertEquals(3,$game->getTotalGoals());
        $this->assertEquals('Mexico',$game->getHomeTeamName());
        $this->assertEquals('Germany',$game->getAwayTeamName());
        $this->assertEquals(1,$game->getHomeTeamScore());
        $this->assertEquals(2,$game->getAwayTeamScore());
    }

    /**
     * @test
     *
     * @return void
     */
    public function sortFinalResultWithZero(): void
    {
        $worldCup = $this->factory->createWorldCup();
        $mex = $this->factory->createTeam('Mexico');
        $ger = $this->factory->createTeam('Germany');
        $game1 = $this->factory->createGame($mex, $ger);

        $spa = $this->factory->createTeam('Spain');
        $port = $this->factory->createTeam('Portugal');
        $game2 = $this->factory->createGame($spa, $port);

        $ita = $this->factory->createTeam('Italy');
        $fra = $this->factory->createTeam('France');
        $game3 = $this->factory->createGame($ita, $fra);
        $worldCup->addGame($game1);
        $worldCup->addGame($game2);
        $worldCup->addGame($game3);

        $worldCup->startGame(0);
        $worldCup->startGame(1);
        $worldCup->startGame(2);

        $worldCup->finishGame(0);
        $worldCup->finishGame(1);
        $worldCup->finishGame(2);

        $result = $worldCup->getFinalResult();

        $this->assertCount(3,$result);

        /**
         * @var Game $game
         */
        $game = array_shift($result);

        $this->assertEquals(0,$game->getTotalGoals());
        $this->assertEquals('Italy',$game->getHomeTeamName());
        $this->assertEquals('France',$game->getAwayTeamName());
        $this->assertEquals(0,$game->getHomeTeamScore());
        $this->assertEquals(0,$game->getAwayTeamScore());

        /**
         * @var Game $game
         */
        $game = array_shift($result);

        $this->assertEquals(0,$game->getTotalGoals());
        $this->assertEquals('Spain',$game->getHomeTeamName());
        $this->assertEquals('Portugal',$game->getAwayTeamName());
        $this->assertEquals(0,$game->getHomeTeamScore());
        $this->assertEquals(0,$game->getAwayTeamScore());

        /**
         * @var Game $game
         */
        $game = array_shift($result);

        $this->assertEquals(0,$game->getTotalGoals());
        $this->assertEquals('Mexico',$game->getHomeTeamName());
        $this->assertEquals('Germany',$game->getAwayTeamName());
        $this->assertEquals(0,$game->getHomeTeamScore());
        $this->assertEquals(0,$game->getAwayTeamScore());
    }

    /**
     * @test
     *
     * @return void
     */
    public function sortAllElementsInFinalResult(): void
    {
        $worldCup = $this->factory->createWorldCup();
        $mex = $this->factory->createTeam('Mexico');
        $ger = $this->factory->createTeam('Germany');
        $game1 = $this->factory->createGame($mex, $ger);

        $spa = $this->factory->createTeam('Spain');
        $port = $this->factory->createTeam('Portugal');
        $game2 = $this->factory->createGame($spa, $port);

        $ita = $this->factory->createTeam('Italy');
        $fra = $this->factory->createTeam('France');
        $game3 = $this->factory->createGame($ita, $fra);
        $worldCup->addGame($game1);
        $worldCup->addGame($game2);
        $worldCup->addGame($game3);
        foreach ($worldCup->getTournament() as $key => $game) {
            $worldCup->startGame($key);
        }

        for ($i = 0; $i < 90; $i++) {
            if (count($worldCup->getTournament()) == 0) {
                break;
            }
            $randKey = array_rand($worldCup->getTournament());
            $random = rand(0, 100);


            if ($random < 10) {
                $worldCup->goalHomeTeam($randKey);
            } elseif ($random < 20) {
                $worldCup->goalAwayTeam($randKey);
            } elseif ($random % 50 == 0) {
                $worldCup->finishGame($randKey);
            }
        }

        foreach ($worldCup->getTournament() as $key => $game) {
            $worldCup->finishGame($key);
        }

        $this->assertCount(3, $worldCup->getFinalResult());
    }

    /**
     * @test
     *
     * @return void
     */
    public function runningMethods(): void
    {

        $worldCupMock = $this->createMock(WorldCup::class);
        $worldCupMock->expects($this->exactly(2))->method('finishGame');
        $worldCupMock->expects($this->exactly(2))->method('startGame');
        $worldCupMock->expects($this->exactly(2))->method('addGame');
        $worldCupMock->expects($this->once())->method('getFinalResult');

        $mex = $this->factory->createTeam('Mexico');
        $ger = $this->factory->createTeam('Germany');
        $game1 = $this->factory->createGame($mex, $ger);

        $spa = $this->factory->createTeam('Spain');
        $port = $this->factory->createTeam('Portugal');
        $game2 = $this->factory->createGame($spa, $port);
        $worldCupMock->addGame($game1);
        $worldCupMock->addGame($game2);
        $worldCupMock->startGame(1);
        $worldCupMock->startGame(2);
        $worldCupMock->finishGame(1);
        $worldCupMock->finishGame(2);
        $finalResult = $worldCupMock->getFinalResult();

    }
}