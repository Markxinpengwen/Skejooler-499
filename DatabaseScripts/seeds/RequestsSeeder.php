<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

// require the Faker autoloader
require_once 'vendor/fzaninotto/faker/src/autoload.php';

class RequestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
	 *
     * @return void
     */
    public function run()
    {		
		
		//-------------------------------------------------------------------------------------
		//STEP 1) SETUP
		//-------------------------------------------------------------------------------------
		
		//Constants
		$NUM_REQUESTS = 25;
		$DEFAULT_AUTO_INCREMENT = 20000;
		
		//Variables
		$num_students=0;
		$num_centers=0;
		$faker = Faker\Factory::create();
		
		//Print
		echo "RequestSeeder] Creating ".$NUM_REQUESTS." Requests from students.\n";
		
		//Acquire initial RID auto_increment value from database, and then print.
		$result = DB::select(DB::raw("SHOW TABLE STATUS LIKE 'Requests'"));
		$rid = $result[0]['Auto_increment'];
		if($rid!=0){
			echo "\nRequests Auto_Increment value is: ".$rid.".\n";
		}else{
			$rid = $DEFAULT_AUTO_INCREMENT;
			echo "\nRequests next Auto_Increment value was 0.\n\tSetting to default value of ".$rid.".\n";
		}
		
		//Students and Centers empty check
		if (count($num_students) == 0 || count($num_centers) == 0){
			echo "\n\nNO STUDENTS AND/OR NO CENTERS TO WORK WITH. TERMINATING...\n";
			return;
		}
		
		//Count number of students, and collect/shuffle SID's
		$students;
		$result = DB::select(DB::raw("SELECT count(*) AS 'count' FROM students;"));
		$num_students = $result[0]['count'];
		if ($num_students < $NUM_REQUESTS){
			echo "There are only ".$num_students." students for ".$NUM_REQUESTS." requests.\n\tMultiple request per available student.";
			$students = DB::table('students')->take($num_students)->pluck('sid');
		}else{
			echo "Student Count: ".$num_students.".";
			$students = DB::table('students')->take($NUM_REQUESTS)->pluck('sid');
		}
		$students = $students->toArray();
		shuffle($students);
		unset($result);
		
		//Count number of Centers, and collect Center's records
		$centers;
		$result = DB::select(DB::raw("SELECT count(*) AS 'count' FROM centers;"));
		$num_centers = $result[0]['count'];
		if ($num_centers < $NUM_REQUESTS){
			echo "\nThere are only ".$num_centers." centers for ".$NUM_REQUESTS." requests.\n\tMultiple request per available center.";
			$centers = DB::table('centers')->take($num_centers)->get();
		}else{
			echo "\nCenter Count: ".$num_centers.".";
			$centers = DB::table('centers')->take($NUM_REQUESTS)->get();
		}
		$centers = $centers->toArray();
		unset($result);
		
		
		//--------------------------------------------------------------------------------
		//STEP 2) CREATING REQUEST VALUES
		//--------------------------------------------------------------------------------
		
		//If number of requests can be satisfied without modular math
		if(count($students)>=$NUM_REQUESTS && count($centers)>=$NUM_REQUESTS) {
			//For the randomized students list, assign a center to request
			$requests = array();
			$i = 0;
			for($i = 0;$i<$NUM_REQUESTS;$i++){
				//Define enumerated variables and switch assignments
				$type="";
				switch(rand(0,2)){
					case 0:
						$type="Final";
						break;
					case 1:
						$type="Midterm";
						break;
					case 2:
						$type="Other";
						break;					
				};
				$medium="";
				switch(rand(0,2)){
					case 0:
						$medium="Paper";
						break;
					case 1:
						$medium="Online";
						break;
					case 2:
						$medium="Other";
						break;					
				};
				$requests[$i] = [
					//Request Identifiers
					'rid' => ($rid+$i),
					'student' => $students[$i],
					'center' => $centers[$i]['cid'],
					'center_name' => $centers[$i]['name'],
					'center_street_name' => $centers[$i]['street_name'],
					'center_city' => $centers[$i]['city'],
					'center_province' => $centers[$i]['province'],
					'center_country' => $centers[$i]['country'],
					'center_postal_code' => $centers[$i]['postal_code'],
					'center_contact' => $centers[$i]['phone'],
					'center_contact_email' => $faker->safeEmail,
					'center_contact_number' => substr($faker->e164PhoneNumber,-11),
					//other attributes
					'prefered_date_1' => $faker->dayOfWeek,
					'prefered_date_2' => $faker->dayOfWeek,
					//'prefered_time' =>
					'course_code' => substr($faker->unixTime($max = 'now'), 4),
					'additional_requirements' => $faker->realText($maxNbChars = 200, $indexSize = 2),
					'exam_type' => $type,
					'exam_medium' => $medium,
					'approval_status' => rand(0,1),
					//Request Metainformation
					'remember_token' => str_random(100),
					'created_at' => $faker->dateTimeThisDecade($max = 'now'),
					'updated_at' => $faker->dateTimeThisMonth($max = 'now')
				];
			}//for
		}else{
			//Else, we need to bust out the modular math... (//!@#This can be collapsed later)
			//rid = rid + i
			//s = (r%s)-1
			//c= (r%c)-1
			
			//For the randomized students list, assign a center to request
			$requests = array();
			$i = 1;
			for($i = 1;$i<=$NUM_REQUESTS;$i++){
				$idx=($i%$num_centers);
				//echo "\nFor Request: ".($rid+$i-1)." (".$rid."+".$i."-1), the idx value is: ".$idx.". Grabs element centers[".$idx."].";
				
				//Define enumerated variables and switch assignments
				$type="";
				switch(rand(0,2)){
					case 0:
						$type="Final";
						break;
					case 1:
						$type="Midterm";
						break;
					case 2:
						$type="Other";
						break;					
				};
				$medium="";
				switch(rand(0,2)){
					case 0:
						$medium="Paper";
						break;
					case 1:
						$medium="Online";
						break;
					case 2:
						$medium="Other";
						break;					
				};
				$requests[$i-1] = [
					//Request Identifiers
					'rid' => ($rid+$i-1),
					//'student' => $students[($i%$num_students)-1], //??
					'student' => (($num_students < $NUM_REQUESTS)? $students[($i%$num_students)] : $students[($i%$num_students)-1] ),
					'center' => $centers[$idx]['cid'],
					'center_name' => $centers[$idx]['name'],
					'center_street_name' => $centers[$idx]['street_name'],
					'center_city' => $centers[$idx]['city'],
					'center_province' => $centers[$idx]['province'],
					'center_country' => $centers[$idx]['country'],
					'center_postal_code' => $centers[$idx]['postal_code'],
					'center_contact' => $centers[$idx]['phone'],
					'center_contact_email' => $faker->safeEmail,
					'center_contact_number' => substr($faker->e164PhoneNumber,-11),
					//other attributes
					'prefered_date_1' => $faker->dayOfWeek,
					'prefered_date_2' => $faker->dayOfWeek,
					//'prefered_time' =>
					'course_code' => substr($faker->unixTime($max = 'now'), 4),
					'additional_requirements' => $faker->realText($maxNbChars = 200, $indexSize = 2),
					'exam_type' => $type,
					'exam_medium' => $medium,
					'approval_status' => rand(0,1),
					//Request Metainformation
					'remember_token' => str_random(100),
					'created_at' => $faker->dateTimeThisDecade($max = 'now'),
					'updated_at' => $faker->dateTimeThisMonth($max = 'now')
				];
			}//for
			
		}			
		echo "\nGenerated ".$NUM_REQUESTS." Requests.\n";
		unset($i);
		
		//--------------------------------------------------------------------------------
		//STEP 3) SUBMITTING REQUESTS VALUES TO DATABASE
		//--------------------------------------------------------------------------------
		
		//Now we submit all of the values into the database
		$i = 0;
		for($i = 0; $i < count($requests); $i++) {
			//Submit Requests
			DB::table('requests')->insert(
				[					
					//Request Identifiers
					'rid' => $requests[$i]['rid'],
					'student' => $requests[$i]['student'],
					'center' => $requests[$i]['center'],
					'center_name' => $requests[$i]['center_name'],
					'center_street_name' => $requests[$i]['center_street_name'],
					'center_city' => $requests[$i]['center_city'],
					'center_province' => $requests[$i]['center_province'],
					'center_country' => $requests[$i]['center_country'],
					'center_postal_code' => $requests[$i]['center_postal_code'],
					'center_contact' => $requests[$i]['center_contact'],
					'center_contact_email' => $requests[$i]['center_contact_email'],
					'center_contact_number' => $requests[$i]['center_contact_number'],
					//other attributes
					'prefered_date_1' => $requests[$i]['prefered_date_1'],
					'prefered_date_2' => $requests[$i]['prefered_date_2'],
					//'prefered_time' =>
					'course_code' => $requests[$i]['course_code'],
					'additional_requirements' => $requests[$i]['additional_requirements'],
					'exam_type' => $requests[$i]['exam_type'],
					'exam_medium' => $requests[$i]['exam_medium'],
					'approval_status' => $requests[$i]['approval_status'],
					//Request Metainformation
					'remember_token' => $requests[$i]['remember_token'],
					'created_at' => $requests[$i]['created_at'],
					'updated_at' => $requests[$i]['updated_at']
				]
			);
			echo "\n\t- Request ".$requests[$i]['rid'].": S-".$requests[$i]['student']." to C-".$requests[$i]['center'].".";
		}
		echo "\n";
		
    }//run
	
}

/*
OLD CODE:

//Acquire Valid Students SID's, shuffle for random order	
		// I\S\Collection
		$students = DB::table('students')->take($NUM_REQUESTS)->pluck('sid');
		echo "A) Class of students is: ".get_class($students).".\n";
		var_dump($students);	
		//Array
		//$list = $students[0]; //integer, apparently
		$list = $students->toArray();
		shuffle($list);
		echo "\ndunping list:\n";
		var_dump($list);		
		//TEST: Print
		echo "\n\nTEst PRinting Students Table Select Results:\n";
		foreach($list as $s){
			echo $s.".\n";
		}
		
//Acquire Valid Centers data
		//$centers = DB::table('centers')->pluck('cid');
		$centers = DB::table('centers')->take($NUM_REQUESTS)->get();		
		$centers = $centers->toArray();
		var_dump($centers);
		//TEst print
		echo"\n\nCenters\n\n";
		foreach($centers as $s){
			echo $s['cid'].".\n";
		}
*/