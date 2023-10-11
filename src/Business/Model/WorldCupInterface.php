<?php

namespace App\Business\Model;

interface WorldCupInterface
{
    /**
     * @param GameInterface $game
     * @return void
     */
    public function addGame(GameInterface $game);

    /**
     * @return array<int,Game>
     */
    public function getTournament(): array;

    /**
     * @param int $id
     * @return void
     */
    public function goalHomeTeam(int $id): void;

    /**
     * @param int $id
     * @return void
     */
    public function goalAwayTeam(int $id): void;

    /**
     * @param int $id
     * @return void
     */
    public function finishGame(int $id): void;

    /**
     * @param int $id
     * @return void
     */
    public function startGame(int $id): void;

    /**
     * @return array<int,Game>
     */
    public function getFinalResult(): array;
}