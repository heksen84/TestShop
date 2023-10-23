<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin {--username=admin} {--email=admin@testshop.com} {--password=22vWr23hh}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создать администратора';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {

//        $data = ['name' => $this->argument('username'), 'email' => $this->argument('email'), 'password' => $this->argument('password')];
        $data = ['name' => 'admin', 'email' => 'admin@testshop.com', 'password' => '22vWr23hh'];

        $rules = [
            'email' => 'required|unique:users|email',
            'password' => ['required', 'min:6', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/']
        ];

        $messages = [
            'email.required' => "Укажите email",
            'email.string' => "Укажите почту в виде строки",
            'email.unique' => "Почта уже существует",
            'password.required' => "Укажите пароль",
            'password.string' => "Укажите пароль в виде строки",
            'password.confirmed' => "Пароли не совпадают",
            'password.regex' => "Пароль должен быть не менее 6 символов и содержать цифры и специальные символы",
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            $this->info($validator->errors()->first());
            exit(1);
        }

        $user = Admin::create(['email' => mb_strtolower($data['email']), 'password' => Hash::make($data['password']), 'name' => $data['name']]);

        if ($user->save()) {
            $this->info('Админ создан');
        }
        else
            $this->info('Не возможно сохранить запись');
    }
}