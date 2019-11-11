<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
	/**
	* Run the database seeds.
	*
	* @return void
	*/
	public function run()
	{
		$user = User::create([
			'hospcode' => '-1',
			'province' => '12',
			'title_name' => 'admin',
			'name' => 'Talek',
			'lastname' => 'Studio',
			'email' => 'talek@gmail.com',
			'password' => bcrypt('o123456'),
			'status' => 'active'
		]);

		$role = Role::create(['name' => 'admin']);
		$permissions = Permission::pluck('id', 'id')->all();
		$role->syncPermissions($permissions);
		$user->assignRole([$role->id]);
		$role = Role::create(['name' => 'hospital']);
		$role = Role::create(['name' => 'lab']);
		$role = Role::create(['name' => 'guest']);
		$user->syncPermissions($permissions);
	}
}
