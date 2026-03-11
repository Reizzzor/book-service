<?php

namespace App\Console\Commands;

use App\Services\AdminService;
use Illuminate\Console\Command;

class CreateAdminCommand extends Command
{
    protected $signature = 'create:admin';

    protected $description = 'Create admin';

    public function handle(): void
    {
        $email = $this->ask('Введите email');
        $password = $this->secret('Введите пароль');
        try {
            app(AdminService::class)->create([
                'email' => $email,
                'password' => $password,
            ]);
            $this->info('Команда выполнена успешно!');
        } catch (\Throwable $exception) {
            $this->error($exception->getMessage());
        }
    }
}
