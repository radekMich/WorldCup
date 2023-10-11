<?php

namespace App\Business\Model;

class WorldCup implements WorldCupInterface
{
    /**
     * @var array<int,Game>
     */
    private array $tournament = [];

    /**
     * @var array<int,Game>
     */
    private array $finalResult = [];

    /**
     * @param GameInterface $game
     * @return void
     */
    public function addGame(GameInterface $game): void
    {
        $this->tournament[] = $game;
    }

    /**
     * @return array<int,Game>
     */
    public function getTournament(): array
    {
        return $this->tournament;
    }

    /**
     * @param int $id
     * @return void
     */
    public function startGame(int $id): void
    {
        $this->tournament[$id]->setGameStarted();
    }


    /**
     * @param int $id
     * @return void
     */
    public function finishGame(int $id): void
    {
        $this->tournament[$id]->setGameFinished();
        $this->addToFinalResul($id);
        unset($this->tournament[$id]);
    }


    /**
     * @param int $id
     * @return void
     */
    public function goalHomeTeam(int $id): void
    {
        $this->tournament[$id]->goalHomeTeam();
    }

    /**
     * @param int $id
     * @return void
     */
    public function goalAwayTeam(int $id): void
    {
        $this->tournament[$id]->goalAwayTeam();
    }

    /**
     * @return array<int,Game>
     */
    public function getFinalResult(): array
    {
        return $this->finalResult;
    }


    /**
     * @param int $id
     * @return void
     */
    private function addToFinalResul(int $id): void
    {
        if (count($this->finalResult) == 0) {
            $this->finalResult[$id] = $this->tournament[$id];
            return;
        }
        $newScore = $this->tournament[$id]->getTotalGoals();

        $temp = [];
        $added = false;
        foreach ($this->finalResult as $key => $game) {
            if ($newScore > $game->getTotalGoals()) {
                $temp[$id] = $this->tournament[$id];
                $temp[$key] = $this->finalResult[$key];
                $added = true;
            } elseif ($newScore == $game->getTotalGoals()) {
                if ($id > $key) {
                    $temp[$id] = $this->tournament[$id];
                    $temp[$key] = $this->finalResult[$key];
                } else {
                    $temp[$key] = $this->finalResult[$key];
                    $temp[$id] = $this->tournament[$id];
                }
                $added = true;
            } else {
                $temp[$key] = $this->finalResult[$key];
            }
        }
        if (!$added) {
            $temp[$id] = $this->tournament[$id];
        }

        $this->finalResult = $temp;
    }
}