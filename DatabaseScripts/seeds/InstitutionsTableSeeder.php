<?php

use Illuminate\Database\Seeder;

class InstitutionsTableSeeder extends Seeder
{
	/**
	* NOTES:
	* - Timestamps are currently being recorded as NULL in the database. Feature for later.
	* - RememberToken also currently being recorded as NULL in the database. Feature for later.
	*/
	
	
	/**
     * Seed the Institutions Table, given predefined values.
     * 
     * @return void
     */
    public function run()
    {
        //Constants
		$NUM_RECORDS=4;
		
		//Acquire initial auto_inc value on institutions 
		//!@# (This is a shitty hack, change this ASAP!!!)
		$iid=0;
		$result = DB::select(DB::raw("SHOW TABLE STATUS LIKE 'Institutions'"));
		$result = get_object_vars($result[0]);
		$j=1;
		foreach ($result as $r){
			if($j==11){$iid=$r;break;}
			$j++;
		}
		
		//Insert each created Record into the database.
		for($i = 0; $i < $NUM_RECORDS; $i++) {
			//use 'insertGetId' for grabbing auto-incremented field
			$iid = DB::table('Institutions')->insertGetId(
				[					
					'iid' => $iid,
					'name' => "University ". $iid,
					'description' => "Description". $iid,
					'hasPaid' => rand(0,1)
				]
			);
			//Echo Record, and Increment iid
			echo "\tInstitutionsSeeder] Inserted iid ". $iid .": ". "University". $iid .".\n";
			$iid++;
		}//for
    }
	
}

/**
OLD:
//SELECT AUTO_INCREMENT FROM information_schema.tables WHERE table_name = 'institutions' AND table_schema = 'skejooler' 
		$id = DB::table('information_schema.tables')->select('AUTO_INCREMENT')->where('table_name', '=', 'institutions')->where('table_schema', '=', 'skejooler')->get();
	
*/