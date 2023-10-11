<?php

namespace App\Business\Model;

use App\Business\Exception\EmptyNameException;
use App\Business\Exception\NegativeResultException;

class Team implements TeamInterface
{
    /**
     * @var int
     */
    private int $score;

    /**
     * @param string $name
     */
    public function __construct(private string $name)
    {
        $this->checkName();
        $this->score = 0;
    }

    /**
     * @return void
     */
    public function addGoal(): void
    {
        $this->score++;
    }


    /**
     * @return void
     * @throws NegativeResultException
     */
    public function removeGoal(): void
    {
        if ($this->score == 0) {
            throw new NegativeResultException();
        }
        $this->score--;
    }


    /**
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return void
     * @throws EmptyNameException
     */
    private function checkName(): void
    {
        if (empty($this->getName())) {
            throw new EmptyNameException();
        }
    }
}