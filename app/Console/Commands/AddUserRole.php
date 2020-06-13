<?php
declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\UserService;
use App\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

final class AddUserRole extends Command
{
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add User role';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:add-role {user : The name of the user} {role : The name of the role}';

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
        $this->userService = $userService;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $userName = $this->argument('user');
        $roleName = $this->argument('role');

        try {
            $user = User::query()->where(['name' => $userName])->firstOrFail();
            $role = Role::query()->where(['name' => $roleName])->firstOrFail();
            $this->userService->assignUserRole($user, $role);
            $this->info('Role assigned successfuly');
            \var_dump($user->roles->pluck('name','name')->all());
        }catch (\Exception $exception){
            $this->error('Exception: ' . $exception->getMessage());
        }

    }
}
