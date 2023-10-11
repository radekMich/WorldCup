<?php

namespace App\Business\Model;

use App\Business\Exception\NoPlayException;
use App\Business\Exception\SameTeamException;

class Game implements GameInterface
{
    /**
     * @var int
     */
    private int $totalGoals;

    /**
     * @var bool
     */
    private bool $gameStarted;

    /**
     * @var bool
     */
    private bool $gameFinished;

    /**
     * @param TeamInterface $home
     * @param TeamInterface $away
     */
    public function __construct(private TeamInterface $homeTeam, private TeamInterface $awayTeam)
    {
        $this->checkTeams();
        $this->totalGoals = 0;
        $this->gameStarted = false;
        $this->gameFinished = false;
    }

    /**
     * @return int
     */
    public function getTotalGoals(): int
    {
        if (!$this->getGameFinished()) {
            return $this->homeTeam->getScore() + $this->awayTeam->getScore();
        }

        return $this->totalGoals;
    }

    /**
     * @return string
     */
    public function getHomeTeamName(): string
    {
        return $this->homeTeam->getName();
    }

    /**
     * @return string
     */
    public function getAwayTeamName(): string
    {
        return $this->awayTeam->getName();
    }

    /**
     * @return int
     */
    public function getHomeTeamScore(): int
    {
        return $this->homeTeam->getScore();
    }

    /**
     * @return int
     */
    public function getAwayTeamScore(): int
    {
        return $this->awayTeam->getScore();
    }

    /**
     * @return void
     */
    public function goalHomeTeam()
    {
        $this->isInGame();
        $this->homeTeam->addGoal();
    }

    /**
     * @return void
     */
    public function goalAwayTeam()
    {
        $this->isInGame();
        $this->awayTeam->addGoal();
    }

    /**
     * @return bool
     */
    public function getGameStarted(): bool
    {
        return $this->gameStarted;
    }

    /**
     * @return bool
     */
    public function getGameFinished(): bool
    {
        return $this->gameFinished;
    }

    /**
     * @return void
     */
    public function setGameFinished(): void
    {
        $this->gameFinished = true;
        $this->totalGoals = $this->homeTeam->getScore() + $this->awayTeam->getScore();
    }


    /**
     * @return void
     */
    public function setGameStarted(): void
    {
        $this->gameStarted = true;
    }


    /**
     * @return void
     * @throws NoPlayException
     */
    private function isInGame()
    {
        if (!$this->getGameStarted() || $this->getGameFinished()) {
            throw new NoPlayException();
        }
    }

    /**
     * @return void
     * @throws SameTeamException
     */
    private function checkTeams()
    {
        if ($this->awayTeam->getName() === $this->homeTeam->getName()) {
            throw new SameTeamException();
        }
    }

    public function __toString(): string
    {
        return $this->getHomeTeamName()
            . " - "
            . $this->getAwayTeamName()
            . " "
            . $this->getHomeTeamScore()
            . " : "
            . $this->getAwayTeamScore();
    }
}