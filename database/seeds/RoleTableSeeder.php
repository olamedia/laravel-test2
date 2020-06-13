<?php
declare(strict_types=1);

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

final class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var \Spatie\Permission\Models\Role $adminRole */
        $adminRole = Role::create([
            'name' => 'Admin'
        ]);
        $permissionIds = Permission::pluck('id', 'id')->all();
        $adminRole->syncPermissions($permissionIds);
    }
}
