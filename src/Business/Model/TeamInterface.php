<?php

namespace App\Business\Model;

interface  TeamInterface
{
    /**
     * @return void
     */
    public function addGoal(): void;

    /**
     * @return void
     */
    public function removeGoal(): void;


    /**
     * @return int
     */
    public function getScore(): int;

    /**
     * @return string
     */
    public function getName(): string;
}