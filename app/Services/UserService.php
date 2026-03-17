<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function create(array $params): User
    {
        $this->user = new User();
        $this->user->fill($params);
        $this->user->save();

        return $this->user;
    }
}
