<?php

namespace Tests\Unit;

use App\Services\UserService;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    public function testCreateUser()
    {
        $params = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'surname' => 'Smith',
            'email' => 'test@test.ru',
            'password' => 'password',
        ];

        $user = app(UserService::class)->create($params);

        $this->assertEquals($params['first_name'], $user->first_name);
        $this->assertEquals($params['last_name'], $user->last_name);
        $this->assertEquals($params['surname'], $user->surname);
        $this->assertEquals($params['email'], $user->email);
    }
}
