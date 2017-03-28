<?php

namespace Tests\Unit;

use App\Repository\ScheduleRepository;
use App\Schedule;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class scheduleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRepository()
    {
        $repository=new ScheduleRepository(new Schedule());
        $schedule=$repository->getAllWithRelation();

            echo $schedule->users;

    }
}
