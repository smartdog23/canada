<?php

namespace App\Repositories;

use App\Entities\User;

class UserRepository {

    protected $entity;

//    public function __construct(User $entity) {
//        $this->entity = $entity;
//    }

    public function getUserToConfirm($token) {
        return User::where('confirmation_code', $token)->first();
    }

}