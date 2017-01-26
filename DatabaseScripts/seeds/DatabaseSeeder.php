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
		echo "________________________________\n";
		echo "Seeding Institution...\n";
		echo "________________________________\n\n";
		
		//Institution Seeder
		$this->call(InstitutionsTableSeeder::class);

		//STEP 2) Call Dependent Table Seeders:
		echo "\n________________________________";
		echo "\nSeeding Users, Students, and Centers...\n";
		echo "________________________________\n\n";
		
		//Giant Seeder
		$this->call(GiantTableSeeder::class);
		
		//STEP 3) Call Request Table Seeders:
		echo "\n________________________________";
		echo "\nSeeding Requests...\n";
		echo "________________________________\n\n";
		
		//Requests Seeder
		$this->call(RequestsSeeder::class);
		
		
    }
}
