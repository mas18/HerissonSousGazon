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
        /*
        $scheduleRepository=new ScheduleRepository(new Schedule());
        $schedule=$scheduleRepository->getAllWithRelation();

            echo $schedule->users;
        */

    }
    public function testCount()
    {
        $repository=new ScheduleRepository(new Schedule());
        $count=$repository->getPlacedUsedOnSchedule(1);
        echo "Affichage du resultat ::     ".$count;
        self::assertNotSame($count,0);
    }
}
