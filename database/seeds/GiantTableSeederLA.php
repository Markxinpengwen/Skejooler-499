<?php

use Illuminate\Database\Seeder;

// require the Faker autoloader
require_once 'vendor/fzaninotto/faker/src/autoload.php';//old seeder works fine in LA

class GiantTableSeederLA extends Seeder
{
	/**
     * Seeds ALL the Dependant tables
     *
     * @return void
     */
    public function run()
    {
        
		//-------------------------------------------------------------------------------------
		//STEP 1) SETUP
		//-------------------------------------------------------------------------------------
		
		//Constants
		$NUM_STUDENTS=10;
		$NUM_CENTERS=5;
		$NUM_ADMINS=2;
        $FAKER_SEED=1234;

        //Regex Values
        $REGEX_PATTERN = array(' ','-',',');
        $REGEX_REPLACE = array('_', '', '_');

		//Auto_Increment default values
		$USERS_DEFAULT_AUTO_INCREMENT = 10000;
		$STUDENTS_DEFAULT_AUTO_INCREMENT = 10000;
		$CENTERS_DEFAULT_AUTO_INCREMENT = 10000;

		//Minimum date
        $MINIMUM_DATE= "1970-01-02 00:00:01";
		
		//Print
		echo "GiantTableSeeder] Seeding ".($NUM_STUDENTS+$NUM_CENTERS+$NUM_ADMINS). " Users: ".$NUM_STUDENTS. " Students, and ".$NUM_CENTERS . " Centers, and ".$NUM_ADMINS." Admins.\n";
		
		//Faker
		$faker = Faker\Factory::create();

        //Choice for Standardized Seed
        echo "\nUse Standardized Seed? (y/n):";
        $fp = fopen("php://stdin","r");
        $input = rtrim(fgets($fp, 1024));
        if($input=="y" || $input=="Y"){
            $faker->seed($FAKER_SEED);
        }
		
		//(For Students) Check for Institutions for 'institution' foreign key reference.
		$result = DB::select(DB::raw("SELECT count(*) AS 'count' FROM institutions;"));
        $result = json_decode(json_encode($result),true); //LA Workaround. Boolean true for returned as associative array.
		$num_institutions = $result[0]['count'];
		$institutions;
		if ($num_institutions < $NUM_STUDENTS){
			echo "There are only ".$num_institutions." Institutions for ".$NUM_STUDENTS." Students.\n\tMultiple students per available institution.\n";
			$institutions = DB::table('institutions')->pluck('iid')->take($num_institutions);
		}else{
			echo "Institution Count: ".$num_institutions.".\n";
			$institutions = DB::table('institutions')->pluck('iid')->take($NUM_STUDENTS);
		}
		$institutions = $institutions->toArray();		
		shuffle($institutions);
		
		//Acquire initial auto_increment values from database (for students, users, and centers) and then print them.
		//Students
		$result = DB::select(DB::raw("SHOW TABLE STATUS LIKE 'Students'"));
        $result = json_decode(json_encode($result),true); //LA Workaround. Boolean true for returned as associative array.
		$sid = $result[0]['Auto_increment'];
		if($sid!=0){
			echo "Students Auto_Increment value is: ".$sid.".\n";
		}else{
			$sid = $STUDENTS_DEFAULT_AUTO_INCREMENT;
			echo "Students next Auto_Increment value was 0.\n\tSetting to default value of ".$sid.".\n";
		}
		//Users
		$result = DB::select(DB::raw("SHOW TABLE STATUS LIKE 'Users'"));
        $result = json_decode(json_encode($result),true); //LA Workaround. Boolean true for returned as associative array.
		$id = $result[0]['Auto_increment'];
		if($id!=0){
			echo "Users Auto_Increment value is: ".$id.".\n";
		}else{
			$id = $USERS_DEFAULT_AUTO_INCREMENT;
			echo "Users next Auto_Increment value was 0.\n\tSetting to default value of ".$id.".\n";
		}
		//Centers
		$result = DB::select(DB::raw("SHOW TABLE STATUS LIKE 'Centers'"));
        $result = json_decode(json_encode($result),true); //LA Workaround. Boolean true for returned as associative array.
		$cid = $result[0]['Auto_increment'];
		if($cid!=0){
			echo "Centers Auto_Increment value is: ".$cid.".\n";
		}else{
			$cid = $CENTERS_DEFAULT_AUTO_INCREMENT;
			echo "Centers next Auto_Increment value was 0.\n\tSetting to default value of ".$cid.".\n";
		}
		
		unset($result);
		
		//First, we will create the Student and Center arrays with all of the values in them.
		//Second, we will create the User table, and entries, based on the values in the Student/Center arrays.
		
		//--------------------------------------------------------------------------------
		//STEP 2) CREATING VALUES FOR STUDENT, CENTERS, AND USER TABLES
		//--------------------------------------------------------------------------------
		
		//Student Array
		$students = array();
		for($i = 0; $i < $NUM_STUDENTS; $i++) {
			//Define enumerated variables and switch assignments
			$gender="";
			switch(rand(0,3)){
				case 0:
					$gender="male";
					break;
				case 1:
					$gender="female";
					break;
				case 2:
					$gender="not_declared";
					break;
				case 3:
					$gender="transgender";
					break;					
			};
			$school = $institutions[($i%$num_institutions)];
			$students[$i] = [
				'sid' => 0,
				'firstName' => $faker->firstName,
				'lastName' => $faker->lastName,
				'institution' => $school,
				'sex' => $gender,
				'age' => (rand(0,40)+ 20),
				'phone' => substr($faker->e164PhoneNumber,-11),
				'created_at' => $faker->dateTimeThisDecade($max = 'now'),
				'updated_at' => $faker->dateTimeThisMonth($max = 'now')
			];
		}//for
		echo "\nGenerated ". $NUM_STUDENTS . " Students.";
	
		//Centers Array
		$centers = array();
		for($i = 0; $i < $NUM_CENTERS; $i++) {
		    $name=$faker->company();
			$centers[$i] = [
				'cid' => 0, //determined later
				'name' =>  "".$name. " Center",
                'center_email' => "".str_replace($REGEX_PATTERN,$REGEX_REPLACE,$name)."@example.org",
				'phone' => substr($faker->e164PhoneNumber,-11),
				'description' => $faker->bs() .$faker->bs() .$faker->bs(),
				'canSupportOnlineExam' => rand(0,1),
				'cost' => rand(40,400),
				'street_address' => $faker->streetAddress(),
				'city' => $faker->city(),
				'province' => 'British_Columbia',
				'country' => 'Canada',
				'postal_code' => substr($faker->e164PhoneNumber,-6),
				'longitude' => $faker->longitude($max = -119.2, $min = -127.0 ),
				'latitude' => $faker->latitude($max = 52.11, $min = 49.04 ),
				'created_at' => $faker->dateTimeThisDecade($max = 'now'),
				'updated_at' => $faker->dateTimeThisMonth($max = 'now')
			];
		}//for
		echo "\nGenerated ". $NUM_CENTERS . " Centers.";

		//
		//Currently, no personal information for admins.
		//

		//Users Array		
		$users = array();
		$password="password"; //!@#Same Password for all users
		//Populate array
		for($i = 0; $i < ($NUM_CENTERS+$NUM_STUDENTS+$NUM_ADMINS); $i++) {
			//Recalculate Time, and Hash Options
			$now = getdate();
			$options = [
				'cost' => 10,
				'salt' => str_random(22) //22 required minimum //str_random safe? random_bytes
			];
			
			//Create Email and 'type' (if Student, Center, or Admin)
            $email=""; $uname=""; $type="";
			if($i < $NUM_CENTERS){
				//Center: First 10 letters of name + random digit 0-9
                $email = str_replace($REGEX_PATTERN,$REGEX_REPLACE,substr($centers[$i]['name'],0,10) . rand(0,9) . "@example.org"); ////$email = substr($centers[$i]['name'],0,10) . rand(0,9) . "@example.org";
				$type = "center";
				$uname=$centers[$i]['name'];
			}elseif($i < ($NUM_CENTERS+$NUM_STUDENTS)){
				//Student: First 5 letters of First and Last Names
                $email = str_replace($REGEX_PATTERN,$REGEX_REPLACE,substr($students[($i-$NUM_CENTERS)]['firstName'],0,5) . substr($students[$i-$NUM_CENTERS]['lastName'],0,5) . rand(0,9) . "@example.org"); //$email = substr($students[($i-$NUM_CENTERS)]['firstName'],0,5) . substr($students[$i-$NUM_CENTERS]['lastName'],0,5) . rand(0,9) . "@example.org";
				$type = "student";
                $uname=$students[($i-$NUM_CENTERS)]['firstName'] . " " . $students[$i-$NUM_CENTERS]['lastName'];
			}else {
                //admin: first 5 of first name + last name, and a random 0-9
                $uname = $faker->firstName . " " . $faker->lastName;
                $email = substr($uname, 0, 5) . rand(0, 9) . "@example.org";
                $type = "admin";
            }

			$users[$i] = [
				'uid' => $id, //remember id is incremented below //!@#changed to 'uid'
				'email' => $email,
                //'name' => $uname, //@!# workaround for Mark.//Now depricated by Brett and Mark
				'salt' => $options['salt'],
				'password' => password_hash($password, PASSWORD_DEFAULT, $options),
				'type' => $type,
				'remember_token' => str_random(100),
				'created_at' => $faker->dateTimeThisDecade($max = 'now'),
				'updated_at' => $faker->dateTimeThisMonth($max = 'now')
			];
			
			//Assign this UID to either Student or Center
			if($i<$NUM_CENTERS){
				$centers[$i]['cid'] = $id;
			}elseif($i < ($NUM_CENTERS+$NUM_STUDENTS)){
				$students[($i-$NUM_CENTERS)]['sid'] = $id;
			}
			
			//Increment id
			$id++;
		}//for		
		
		
		//--------------------------------------------------------------------------------
		//STEP 3) SUBMITTING USER, CENTER, AND STUDENT VALUES TO DATABASE
		//--------------------------------------------------------------------------------
		
		//Users
		echo "\n\nInserting Users (including admins):";
		for($i = 0; $i < ($NUM_CENTERS+$NUM_STUDENTS+$NUM_ADMINS); $i++) {
			//Submit Users
			DB::table('Users')->insert(
				[
                    'id' => $users[$i]['uid'], //!@#here
				    'uid' => $users[$i]['uid'], //!@#changed to 'uid'
					'email' => $users[$i]['email'],
                    //'name' => $users[$i]['name'],
					'salt' => $users[$i]['salt'],
					'password' => $users[$i]['password'],
					'type' => $users[$i]['type'],
                    'last_logged_in' => $MINIMUM_DATE,
					'remember_token' => $users[$i]['remember_token'],
					'created_at' => $users[$i]['created_at'],
					'updated_at' => $users[$i]['updated_at']
				]
			);
			echo "\n\t- User ID ".$users[$i]['uid'].": ". $users[$i]['email'];
		}
		
		//Centers AND Students
		echo "\n\nInserting Centers/Students:";
		for($i = 0; $i < ($NUM_CENTERS+$NUM_STUDENTS); $i++) {
			//Submit Either Student OR Center
			if($i < $NUM_CENTERS){
				//use 'insertGetId' for grabbing auto-incremented field
				DB::table('Centers')->insert(
					[					
						'cid' => $centers[$i]['cid'],
						'name' => $centers[$i]['name'],
                        'center_email' => $centers[$i]['center_email'],
						'phone' => $centers[$i]['phone'],
						'description' => $centers[$i]['description'],
						'canSupportOnlineExam' => $centers[$i]['canSupportOnlineExam'],
						'cost' => $centers[$i]['cost'],
						'street_address' => $centers[$i]['street_address'],
						'city' => $centers[$i]['city'],
						'province' => $centers[$i]['province'],
						'country' => $centers[$i]['country'],
						'postal_code' => $centers[$i]['postal_code'],
						'longitude' => $centers[$i]['longitude'],
						'latitude' => $centers[$i]['latitude'],
						'created_at' => $centers[$i]['created_at'],
						'updated_at' => $centers[$i]['updated_at']
					]
				);
				echo "\n\t- Center ID ".$centers[$i]['cid'].": ".$centers[$i]['name'];
			}else{
				DB::table('Students')->insert(
					[					
						'sid' => $students[($i-$NUM_CENTERS)]['sid'],
						'firstName' => $students[($i-$NUM_CENTERS)]['firstName'],
						'lastName' => $students[($i-$NUM_CENTERS)]['lastName'],
						'institution' => $students[($i-$NUM_CENTERS)]['institution'],
						'sex' => $students[($i-$NUM_CENTERS)]['sex'],
						'age' => $students[($i-$NUM_CENTERS)]['age'],
						'phone' => $students[($i-$NUM_CENTERS)]['phone'],
						'created_at' => $students[($i-$NUM_CENTERS)]['created_at'],
						'updated_at' => $students[($i-$NUM_CENTERS)]['updated_at']
					]
				);
				echo "\n\t- Student ID ".$students[($i-$NUM_CENTERS)]['sid'].": ".$students[($i-$NUM_CENTERS)]['firstName']." ".$students[($i-$NUM_CENTERS)]['lastName'];
			}//if
		}//for	
		echo "\n";
	}//run
	
}//class