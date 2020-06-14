<?php
declare(strict_types=1);

namespace App\Services;

use App\User;
use Spatie\Permission\Models\Role;

final class UserService
{
    /**
     * Assigns role to user.
     *
     * @param \App\Services\Role $role
     */
    public function assignUserRole(User $user, Role $role)
    {
        $user->assignRole($role);
    }

    /**
     * Creates user from data.
     */
    public function createUser(array $data): User
    {
        if (isset($data['password'])) {
            $data['password'] = \bcrypt($data['password']);
        }

        return User::create($data);
    }
}
