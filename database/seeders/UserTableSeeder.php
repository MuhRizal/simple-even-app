<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		User::create([
			'name' => 'John HR',
			'email' => 'john@app.com',
			'password' => bcrypt('password'),
			'role_id' => '1',
			'company_id' => '1',
			'is_active' => 1,
		]);
		User::create([
			'name' => 'Danny HR',
			'email' => 'danny@app.com',
			'password' => bcrypt('password'),
			'role_id' => '1',
			'company_id' => '2',
			'is_active' => 1,
		]);
		User::create([
			'name' => 'Susan Vendor',
			'email' => 'end_user01@app.com',
			'password' => bcrypt('password'),
			'role_id' => '2',
			'company_id' => '3',
			'is_active' => 1,
		]);
		User::create([
			'name' => 'Howard Vendor',
			'email' => 'howard@app.com',
			'password' => bcrypt('password'),
			'role_id' => '2',
			'company_id' => '4',
			'is_active' => 1,
		]);
	}
}
