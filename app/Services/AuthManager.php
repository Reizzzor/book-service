<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\AuthManager as BaseAuthManager;
use Illuminate\Contracts\Auth\Authenticatable;

class AuthManager extends BaseAuthManager
{
    public function user(): ?User
    {
        return $this->authenticatedUser('users');
    }

    public function admin(): ?Admin
    {
        return $this->authenticatedUser('admins');
    }

    private function authenticatedUser(string $provider): ?Authenticatable
    {
        foreach (config('auth.guards') as $guard => $guardParams) {
            if ($provider !== $guardParams['provider']) {
                continue;
            }
            if ($user = $this->guard($guard)->user()) {
                return $user;
            }
        }
        return null;
    }
}
