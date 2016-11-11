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
		echo "Calling Independant Seeders...\n";
		echo "________________________________\n\n";
		
		//Institution Seeder
		$this->call(InstitutionsTableSeeder::class);

		//STEP 2) Call Dependent Table Seeders:
		echo "\n________________________________";
		echo "\nCalling Dependant Seeder...\n";
		echo "________________________________\n\n";
		
		//Giant Seeder
		$this->call(GiantTableSeeder::class);
		
		
    }
}
