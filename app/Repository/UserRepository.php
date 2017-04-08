<?php
/**
 * Created by PhpStorm.
 * User: teuft
 * Date: 20.03.2017
 * Time: 18:43
 */

namespace App\Repository;


use App\User;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user=$user;
    }

    //admin methode
     function save(User $user, $inputs)
    {
        $user->email=$inputs['email'];
        $user->firstname=$inputs['firstname'];
        $user->lastname=$inputs['lastname'];
        $user->street=$inputs['street'];
        $user->city=$inputs['city'];
        $user->tel=$inputs['tel'];
        $user->comment=$inputs['comment'];

        $user->save();
    }


    function getPaginate($nbPerPage)
    {
        return $this->user->orderBy('lastname', 'ASC')->orderBy('firstname', 'ASC')->paginate($nbPerPage);
    }

    function getUsers()
    {
        return $this->user->orderBy('lastname', 'ASC')->orderBy('firstname', 'ASC')->get();
    }

    function store(Array $inputs)
    {

        $user=new $this->user;
        $user->level=$inputs['level'] ;
        $user->password=bcrypt($inputs['password']);
        $this->save($user,$inputs);
        return $user;
    }

    function getById($id)
    {
        return $this->user->findOrFail($id);
    }

    function update($id, $input)
    {   $user=$this->getById($id);
        $user->level=$input['level'] ;
        $this->save($user,$input);
    }

    function destroy($id)
    {

        $this->getById($id)->delete();
    }

    function register(Array $inputs)
    {
        $user=new $this->user;
        $user->password=bcrypt($inputs['password']);
        $user->email=$inputs['email'];
        $user->firstname=$inputs['firstname'];
        $user->lastname=$inputs['lastname'];
        $user->street=$inputs['street'];
        $user->city=$inputs['city'];
        $user->tel=$inputs['tel'];
        $user->comment=$inputs['comment'];

        return $user->save();
    }
    function userUpdate($id, $input)
    {
        $user=$this->getById($id);
        $this->save($user,$input);
    }

    public function findUserWithSubscibedID($id_schedule)
    {
        return User::
            //query inside the other table (n to n relation)
            whereHas('schedules' ,function($query) use ($id_schedule)
                {
                    $query->where ('schedule_id','=',$id_schedule);
                })
                ->get();

    }
    public function findUserWhereIdIsNot($array)
    {
      return  $this->user
            ->whereNotIn('id',$array)
            ->get();
    }
}