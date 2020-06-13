<?php
declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\UserService;
use Illuminate\Console\Command;

final class CreateUser extends Command
{
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create User';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {name} {email} {password}';

    /**
     * @var \App\Services\UserService
     */
    private $userService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UserService $userService)
    {
        parent::__construct();

        $this->userService = $userService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $userName = $this->argument('name');
        $userEmail = $this->argument('email');
        $userPassword = $this->argument('password');

        try {
            $this->userService->createUser([
                'name' => $userName,
                'email' => $userEmail,
                'password' => $userPassword
            ]);
            $this->info('User created successfuly');
        } catch (\Exception $exception) {
            $this->error('Exception: ' . $exception->getMessage());
        }
    }
}
