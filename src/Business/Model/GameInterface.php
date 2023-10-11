<?php

namespace App\Business\Model;

interface GameInterface
{
    /**
     * @return int
     */
    public function getTotalGoals(): int;

    /**
     * @return string
     */
    public function getHomeTeamName(): string;

    /**
     * @return string
     */
    public function getAwayTeamName(): string;

    /**
     * @return int
     */
    public function getHomeTeamScore(): int;

    /**
     * @return int
     */
    public function getAwayTeamScore(): int;

    /**
     * @return void
     */
    public function goalHomeTeam();

    /**
     * @return void
     */
    public function goalAwayTeam();

    /**
     * @return void
     */
    public function setGameFinished(): void;

    /**
     * @return void
     */
    public function setGameStarted(): void;
}