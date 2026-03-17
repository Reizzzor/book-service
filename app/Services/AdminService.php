<?php

namespace App\Services;

use App\Models\Admin;

class AdminService
{
    public function create(array $params): Admin
    {
        $this->admin = new Admin();
        $this->admin->fill($params);
        $this->admin->save();

        return $this->admin;
    }
}
