<?php

namespace App\Facades;

use Illuminate\Support\Facades\Auth as IlluminateAuth;

/**
 * @method static \App\Models\Admin|null admin()
 * @method static \App\Models\User|null user()
 */
class Auth extends IlluminateAuth
{
}
