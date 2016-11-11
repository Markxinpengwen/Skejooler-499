<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds, in controlled order.
     *
     * @return void
     */
    public function run()
    {
        //STEP 1) Call Independent Table Seeders:
		echo "Calling Independant Seeders...\n";
		echo "-------------------------------\n\n";
		
		//Institution Seeder
		echo "DBSeeder] Seeding Institutions.\n";
		$this->call(InstitutionsTableSeeder::class);

		//STEP 2) Call Dependent Table Seeders:
		//echo "\n\nCalling Dependant Seeders...\n";
		//echo "-------------------------------\n\n";
		
		//Users
		//$this->call(UsersSeeder::class);
		
		
    }
}
