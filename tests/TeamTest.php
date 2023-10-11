<?php
declare(strict_types=1);

namespace App\Tests;

use App\Business\Exception\EmptyNameException;
use App\Business\Exception\NegativeResultException;
use App\Business\WorldCupBusinessFactory;
use PHPUnit\Framework\TestCase;

class TeamTest extends TestCase
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
    public function minusScore(): void
    {
        $this->expectException(NegativeResultException::class);
        $team = $this->factory->createTeam("Poland");

        $team->removeGoal();
    }

    /**
     * @test
     *
     * @return void
     */
    public function emptyName(): void
    {
        $this->expectException(EmptyNameException::class);
        $this->factory->createTeam("");
    }

    /**
     * @test
     *
     * @return void
     */
    public function checkScore(): void
    {
        $team = $this->factory->createTeam("Poland");

        $this->assertEquals(0,$team->getScore());
        $team->addGoal();
        $team->addGoal();
        $this->assertEquals(2,$team->getScore());
        $team->addGoal();
        $team->addGoal();
        $this->assertEquals(4,$team->getScore());
        $team->removeGoal();
        $this->assertEquals(3,$team->getScore());
    }
}