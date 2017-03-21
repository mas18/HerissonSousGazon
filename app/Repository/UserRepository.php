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

    function save(User $user, $inputs)
    {
        //TODO get the information from the imput
        $user->save();
    }

    function getPaginate($nbPerPage)
    {
        return $this->user->paginate($nbPerPage);
    }

    function store(Array $inputs)
    {
        // TODO: Implement store() method.
        $user=new $this->user;
        //TODO ASSIGN THE PASSWORD OF THE USER
        $this->password=bcrypt($inputs['password']);
        $this->save($user,$inputs);
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
}