<?php
declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\UserService;
use App\Validators\UserValidator;
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
     * @var \App\Validators\UserValidator
     */
    private $userValidator;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UserService $userService, UserValidator $userValidator)
    {
        parent::__construct();

        $this->userService = $userService;
        $this->userValidator = $userValidator;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = $this->arguments();

        try {
            $validatedData = $this->userValidator->validateCreate($data);
            $user = $this->userService->createUser($validatedData);
            $this->info('User created successfuly. Token: ' . $user['api_token']);
        } catch (\Exception $exception) {
            $this->error('Exception: ' . $exception->getMessage());
        }
    }
}
