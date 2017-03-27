<?php

namespace Tests\Unit;

use App\Event;
use App\Repository\UserRepository;
use App\Room;
use App\Schedule;
use App\User;
use Illuminate\Cache\Repository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class userTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }
    public function testInsert()
    {
        $repository=new UserRepository(new User());
        $input=[
            'firstname'=>'christ',
            'lastname'=>'cretuute',
            'email'=>str_random(15).'@hotmail.com',
            'password'=>'password',
            'street'=>'password',
            'city'=>'actiy',
            'level'=>0,
            'tel'=>'027845532',
            'comment'=>'un commentaire',
            ];

       $userCreated= $repository->store($input);
        $ressort=$repository->getById($userCreated->id);
        //check if the user in the DB is the same as the user just created
        self::assertEquals($ressort->id,$userCreated->id);

    }
    public function testDelete()
    {

        $repository=new UserRepository(new User());

        $input=[
            'firstname'=>'karlos',
            'lastname'=>'karleus',
            'email'=>str_random(15).'@hotmail.com',
            'password'=>'password',
            'street'=>'password',
            'city'=>'actiy',
            'level'=>0,
            'tel'=>'027845532',
            'comment'=>'un commentaire',
        ];

        $userCreated= $repository->store($input);
        $repository->destroy($userCreated->id);

        try{
            $user=$repository->getById($userCreated->id);
            //if no exception is raised, we are wrong the methode.
            self::assertTrue(false);
        }
        catch (ModelNotFoundException $ex)
        {
            self::assertTrue(true);
        }

    }
    public function  testUpdate()
    {
        $repository=new UserRepository(new User());

        $input=[
            'firstname'=>'karlos',
            'lastname'=>'karleus',
            'email'=>str_random(15).'@hotmail.com',
            'password'=>'password',
            'street'=>'password',
            'city'=>'actiy',
            'level'=>0,
            'tel'=>'027845532',
            'comment'=>'un commentaire',
        ];

        $userCreated= $repository->store($input);
        $inputUpdated=[
            'firstname'=>'updatedFirst',
            'lastname'=>'updatedlast',
            'email'=>str_random(15).'@hotmail.com',
            'street'=>'password',
            'city'=>'updatedCity',
            'level'=>0,
            'tel'=>'027845532',
            'comment'=>'un commentaire',
        ];
        $repository->update($userCreated->id,$inputUpdated);
       $userUpdated= $repository->getById($userCreated->id);
        self::assertNotSame($userCreated->firstname,[$userUpdated->firstname]);
        self::assertNotSame($userCreated->firstname,[$userUpdated->lastname]);
        self::assertNotSame($userCreated->firstname,$userUpdated->city);

        self::assertEquals($inputUpdated['lastname'],$userUpdated->lastname);
        self::assertEquals($inputUpdated['firstname'],$userUpdated->firstname);
        self::assertEquals($inputUpdated['city'],$userUpdated->city);
    }
    public function testRelationShip()
    {

    }

}
