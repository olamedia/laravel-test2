<?php
declare(strict_types=1);

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

final class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'user-grant',
            'news-list',
            'news-create',
            'news-edit',
            'news-delete'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
