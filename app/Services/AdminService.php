<?php

namespace App\Services;

use App\Models\Admin;

class AdminService
{
    public function __construct(private Admin $admin)
    {}

    public function create(array $params): Admin
    {
        $this->admin = new Admin();
        $this->admin->fill($params);
        $this->admin->save();

        return $this->admin;
    }

    public function update(array $params): void
    {
        $this->admin->fill($params);
        $this->admin->save();
    }
}
