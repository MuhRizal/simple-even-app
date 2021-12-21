<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
			'id' => 1,
			'name' => 'Company A'
		]);
		Company::create([
			'id' => 2,
			'name' => 'Company B'
		]);
		Company::create([
			'id' => 3,
			'name' => 'Vendor X'
		]);
		Company::create([
			'id' => 4,
			'name' => 'Vendor Y'
		]);
    }
}
