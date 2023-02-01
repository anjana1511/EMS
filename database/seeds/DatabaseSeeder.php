<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $dev_role = new Role();
		$dev_role->slug = 'admin';
		$dev_role->role_name = 'Admin';
		$dev_role->save();  // roles
		$dev_role->permissions()->attach($dev_permission); //user_permissions

		$manager_role = new Role();
		$manager_role->slug = 'users';
		$manager_role->role_name = 'Users';
		$manager_role->save();
		$manager_role->permissions()->attach($manager_permission);

		$dev_role = Role::where('slug','admin')->first();
		$manager_role = Role::where('slug', 'users')->first();

		$createTasks = new Permission();
		$createTasks->slug = 'create-tasks';
		$createTasks->per_name = 'Create Tasks';
		$createTasks->save(); //permissions
		$createTasks->roles()->attach($dev_role);

		$editUsers = new Permission();
		$editUsers->slug = 'edit-users';
		$editUsers->per_name = 'Edit Users';
		$editUsers->save();
		$editUsers->roles()->attach($manager_role);

		$dev_role = Role::where('slug','developer')->first();
		$manager_role = Role::where('slug', 'manager')->first();
		$dev_perm = Permission::where('slug','create-tasks')->first();
		$manager_perm = Permission::where('slug','edit-users')->first();

		$developer = new User();
		$developer->name = 'Rahul';
		$developer->email = 'rahul@gmail.com';
		$developer->password = bcrypt('secrettt');
		$developer->save();
		$developer->roles()->attach($dev_role);
		$developer->permissions()->attach($dev_perm);  //roles_permissions

		$manager = new User();
		$manager->name = 'Ashish';
		$manager->email = 'ashish@gmail.com';
		$manager->password = bcrypt('secrettt');
		$manager->save();
		$manager->roles()->attach($manager_role);
		$manager->permissions()->attach($manager_perm);

		
    }
}
