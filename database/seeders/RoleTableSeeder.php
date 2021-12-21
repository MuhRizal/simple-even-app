<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
			'id' => 1,
			'name' => 'vendor',
			'display_name' => 'Vendor'
		]);
		Role::create([
			'id' => 2,
			'name' => 'hr',
			'display_name' => 'Company HR'
		]);
    }
}
