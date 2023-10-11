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
    }

    /**
     * @test
     *
     * @return void
     */
    public function minusScore(): void
    {
    }

    /**
     * @test
     *
     * @return void
     */
    public function emptyName(): void
    {
    }

    /**
     * @test
     *
     * @return void
     */
    public function checkScore(): void
    {
    }
}