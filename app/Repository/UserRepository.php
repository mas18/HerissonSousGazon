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
        $user->level=$inputs['level'];
        $user->tel=$inputs['tel'];
        $user->comment=$inputs['comment'];

        $user->save();
    }


    function getPaginate($nbPerPage)
    {
        return $this->user->paginate($nbPerPage);
    }

    function store(Array $inputs)
    {

        $user=new $this->user;

        $user->password=bcrypt($inputs['password']);
        $this->save($user,$inputs);
        return $user;
    }

    function getById($id)
    {
        // TODO: Implement getById() method.
        return $this->user->findOrFail($id);
    }

    function update($id, $input)
    {
        // TODO: Implement update() method.
        $this->save($this->getById($id),$input);
    }

    function destroy($id)
    {
        // TODO: Implement destroy() method.
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

}