<?php

namespace App\Repositories;

// specific implementation of the contract
class DbUserRepository implements UserRepository {

    public function create($attributes){
        dd('create user from DbUserRepository which implements an interface');
    }


    
}
