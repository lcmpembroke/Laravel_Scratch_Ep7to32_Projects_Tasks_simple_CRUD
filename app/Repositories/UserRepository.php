<?php

namespace App\Repositories;

// contract for working with users
interface UserRepository {

    public function create($attributes);
    
}
