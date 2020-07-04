<?php

use App\Base\Models\Permission;
use App\Base\Models\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userAdmin = User::where('email', 'admin@admin.com')->first();
        if ($userAdmin) {
            $userAdmin->delete();
        }
        $userAdmin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        $roleAdmin = Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => 'Administrator',
            'full-access' => 'yes',
        ]);

        $userAdmin->roles()->sync([$roleAdmin->id]);

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $permission_all = [];

        $permission = Permission::create([
            'name' => 'list role',
            'slug' => 'role.index',
            'description' => 'A user can list role',
        ]);

        $permission_all[] = $permission->id;

        $permission = Permission::create([
            'name' => 'show role',
            'slug' => 'role.show',
            'description' => 'A user can see role',
        ]);

        $permission_all[] = $permission->id;

        $permission = Permission::create([
            'name' => 'create role',
            'slug' => 'role.create',
            'description' => 'A user can create role',
        ]);

        $permission_all[] = $permission->id;

        $permission = Permission::create([
            'name' => 'edit role',
            'slug' => 'role.edit',
            'description' => 'A user can edit role',
        ]);

        $permission_all[] = $permission->id;

        $permission = Permission::create([
            'name' => 'destroy role',
            'slug' => 'role.destroy',
            'description' => 'A user can destroy role',
        ]);

        $permission_all[] = $permission->id;

        $roleAdmin->permissions()->sync($permission_all);

    }
}
