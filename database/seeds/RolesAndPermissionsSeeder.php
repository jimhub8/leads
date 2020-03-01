<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create users
        Permission::create(['guard_name' => 'web', 'name' => 'edit users']);
        Permission::create(['guard_name' => 'web', 'name' => 'create users']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete users']);
        Permission::create(['guard_name' => 'web', 'name' => 'view users']);
        Permission::create(['guard_name' => 'web', 'name' => 'restore users']);
        Permission::create(['guard_name' => 'web', 'name' => 'force delete users']);

        // create roles
        Permission::create(['guard_name' => 'web', 'name' => 'create roles']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit roles']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete roles']);
        Permission::create(['guard_name' => 'web', 'name' => 'view roles']);
        Permission::create(['guard_name' => 'web', 'name' => 'restore roles']);
        Permission::create(['guard_name' => 'web', 'name' => 'force delete roles']);

        // create clients
        Permission::create(['guard_name' => 'web', 'name' => 'create clients']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit clients']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete clients']);
        Permission::create(['guard_name' => 'web', 'name' => 'view clients']);
        Permission::create(['guard_name' => 'web', 'name' => 'restore clients']);
        Permission::create(['guard_name' => 'web', 'name' => 'force delete clients']);

        // create orders
        Permission::create(['guard_name' => 'web', 'name' => 'create jobs']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit jobs']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete jobs']);
        Permission::create(['guard_name' => 'web', 'name' => 'view jobs']);


        Permission::create(['guard_name' => 'web', 'name' => 'create jobtypes']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit jobtypes']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete jobtypes']);
        Permission::create(['guard_name' => 'web', 'name' => 'view jobtypes']);

        Permission::create(['guard_name' => 'web', 'name' => 'view reports']);


        // create Super admin
        $role = Role::create(['guard_name' => 'web', 'name' => 'Super admin']);
        // $role->givePermissionTo(Permission::all());


        // this can be done as separate statements
        $role = Role::create(['guard_name' => 'web', 'name' => 'Admin']);
        $role->givePermissionTo('view users');

        // $role = Role::create(['guard_name' => 'clients', 'name' => 'Client']);
        // $role->givePermissionTo('view orders');

        $faker = \Faker\Factory::create();
        $user = User::create([
            'name' => 'Jimmy',
            'email' => 'jimlaravel@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'phone' => $faker->phoneNumber,
            'address' => $faker->address,
        ]);
        $user->assignRole('Super admin');

    }
}
