<?php

/**
 * Author: Barrett Sharpe
 */

/*
 * This file is being used by Brett. It gets rid of unecessary mod logic from original seeder
 * Other, new, changes
 * - each student submits at least 1 requests to each center for each approval permutation type. ie each student submts 5 requests to each center, one of every approval permutation
 * - Added conditional 'scheduled date' for the following approval conditions: (2,2; 1,0; 2,1). Do time +/- 1 year from now
 * - Added iid
 * - Added computer_required
 */

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

// require the Faker autoloader
require_once 'vendor/fzaninotto/faker/src/autoload.php'; //old seeder works fine in LA

class StaticRequestsTableSeederLA extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        //-------------------------------------------------------------------------------------
        //STEP 1) SETUP
        //-------------------------------------------------------------------------------------

        //Constants
        $NUM_REQUESTS = 0; //This value is now calculated
        $DEFAULT_AUTO_INCREMENT = 20000;
        $FAKER_SEED = 1234;
        $MINIMUM_DATE= \Carbon\Carbon::createFromFormat("Y-m-d H:i:s","1970-01-02 00:00:01"); //Datetime Object required for Brett's request, for :00 second values //"1970-01-02 00:00:01";
        $DEFAULT_CODE = "DFLT 000";

        //Variables
        $num_students=0;
        $num_centers=0;
        $faker = Faker\Factory::create();

        //Collect the counts of Students and Centers

        //Acquire initial RID auto_increment value from database, and then print.
        $result = DB::select(DB::raw("SHOW TABLE STATUS LIKE 'requests'"));
        $result = json_decode(json_encode($result),true); //LA Workaround. Boolean true for returned as associative array.
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
        $result = DB::select(DB::raw("SELECT count(*) AS 'count' FROM students;"));
        $result = json_decode(json_encode($result),true); //LA Workaround. Boolean true for returned as associative array.
        $num_students = $result[0]['count'];
        echo "There are ".$num_students." students.";
        $students = DB::table('students')->take($num_students)->get();
        $students = json_decode(json_encode($students),true);
        shuffle($students);
        unset($result);

        //Count number of Centers, and collect Center's records
        $result = DB::select(DB::raw("SELECT count(*) AS 'count' FROM centers;"));
        $result = json_decode(json_encode($result),true); //LA Workaround. Boolean true for returned as associative array.
        $num_centers = $result[0]['count'];
        echo "\nThere are ".$num_centers." centers.";
        $centers = DB::table('centers')->take($num_centers)->get();
        $centers = json_decode(json_encode($centers),true);
        unset($result);

        //Calculate and Print the number of requests
        $NUM_REQUESTS = $num_students * $num_centers * 5; //5 is the number of approval permutations. See below for details
        if($NUM_REQUESTS%5!=0){
            echo "\n *** The number of students (".$num_students.") multiplied by the number of centers (".$num_centers.") must be divisible by 5 (".$NUM_REQUESTS."%5!=0)***";
            return;
        }
        echo "\nRequestSeeder] Calculated. Creating ".$NUM_REQUESTS." Requests from students.\n";

        //--------------------------------------------------------------------------------
        //STEP 2) CREATING REQUEST VALUES
        //-------------------------------------------------------------------------------

        $k = 1;
        for($h=0;$h<$num_students;$h++){
            for ($i = 0; $i < $num_centers; $i++){
                for ($j = 0; $j < 5; $j++){
                    //student h
                    //center i
                    //request apv j

                    //Define enumerated variables and switch assignments
                    $type = "";
                    switch (rand(0, 2)) {
                        case 0:
                            $type = "Final";
                            break;
                        case 1:
                            $type = "Midterm";
                            break;
                        case 2:
                            $type = "Other";
                            break;
                    };
                    $medium = "";
                    switch (rand(0, 2)) {
                        case 0:
                            $medium = "Paper";
                            break;
                        case 1:
                            $medium = "Online";
                            break;
                        case 2:
                            $medium = "Other";
                            break;
                    };

                    //resquest center/student approval status switch (0,1,2) X (0,1,2)
                    $cenApv = "0";
                    $stuApv = "0";
                    $futureScheduled = 0;
                    switch ($j) {
                        //Non-arbitrary Order. Refer to "DecisionTalbe.csv" and the final report for more info.
                        /*
                         * Never be two unseens (1,1)
                         * Never be double deny (should be deleted) (0,0)
                         *
                         * Never be a deny and approved (0,2) and (2,0)
                         *      Switched to (2, 1) and (1,2)
                         */
                        case 0:
                            //ctr yes st yes
                            $cenApv = "2";
                            $stuApv = "2";
                            $futureScheduled = 2;
                            break;
                        case 1:
                            //ctr yes std unseen
                            $cenApv = "2";
                            $stuApv = "1";
                            $futureScheduled = 1;
                            break;
                        case 2:
                            //ctr unseen std yes
                            $cenApv = "1";
                            $stuApv = "2";
                            break;
                        case 3:
                            //ctr no std unseen
                            $cenApv = "0";
                            $stuApv = "1";
                            break;
                        case 4:
                            //ctr unseen, std no
                            $cenApv = "1";
                            $stuApv = "0";
                            $futureScheduled = 1;
                            break;
                        default:
                            echo "\nDEFAULTED";
                            $cenApv = "2";
                            $stuApv = "2";
                            break;
                    }

                    //Creating Appropriate DateTime
                    $scheduledDate = null;
                    if($futureScheduled==2){
                        //Possible Future Past
                        $scheduledDate = $faker->dateTimeBetween($startDate = '-1 years', $endDate = '+1 years', $timezone = 'America/Vancouver');
                    }elseif($futureScheduled==1) {
                        //Possible Future Only
                        $scheduledDate = $faker->dateTimeBetween($startDate = 'now', $endDate = '+1 years', $timezone = 'America/Vancouver');
                    }else{
                        //Default
                        $scheduledDate = $MINIMUM_DATE;
                    }

                    //Set Request array
                    $requests[($k-1)]= [
                        //Request Identifiers
                        'rid' => ($rid + ($k-1)),
                        'sid' => $students[$h]['sid'], //0 indexed
                        'cid' => $centers[$i]['cid'], //0 indexed
                        'iid' => rand(10000,10004), //hard-coded for now. May need to be changed once IID's outside this range.
                        //other attributes
                        'preferred_date_1' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+1 years', $timezone = 'America/Vancouver'),
                        'preferred_date_2' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+1 years', $timezone = 'America/Vancouver'),
                        'scheduled_date' => $scheduledDate,
                        'course_code' => $DEFAULT_CODE,
                        'additional_requirements' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                        'exam_type' => $type,
                        'exam_medium' => $medium,
                        'computer_required' => ((rand(0, 2)==0)? "No" : "Yes"),
                        'student_approval' => $stuApv,
                        'student_notes' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                        'center_approval' => $cenApv,
                        'center_notes' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                    ];

                    //Transform Date Time values, specifically to have :00 for the seconds value. Brett's request
                    $requests[($k-1)]['preferred_date_1'] = $requests[($k-1)]['preferred_date_1']->format('Y-m-d H:i');
                    $requests[($k-1)]['preferred_date_1'] = \Carbon\Carbon::createFromFormat('Y-m-d H:i', $requests[($k-1)]['preferred_date_1'])->toDateTimeString();

                    $requests[($k-1)]['preferred_date_2'] = $requests[($k-1)]['preferred_date_2']->format('Y-m-d H:i');
                    $requests[($k-1)]['preferred_date_2'] = \Carbon\Carbon::createFromFormat('Y-m-d H:i', $requests[($k-1)]['preferred_date_2'])->toDateTimeString();

                    $requests[($k-1)]['scheduled_date'] = $requests[($k-1)]['scheduled_date']->format('Y-m-d H:i');
                    $requests[($k-1)]['scheduled_date'] = \Carbon\Carbon::createFromFormat('Y-m-d H:i', $requests[($k-1)]['scheduled_date'])->toDateTimeString();

                    //rid incrementer
                    $k++;
                }
            }
        }

        //--------------------------------------------------------------------------------
        //STEP 3) SUBMITTING REQUESTS VALUES TO DATABASE
        //--------------------------------------------------------------------------------

        //Now we submit all of the values into the database
        for($i = 0; $i < count($requests); $i++) {
            //Submit Requests
            DB::table('requests')->insert(
                [
                    //Request Identifiers
                    'rid' => $requests[$i]['rid'],
                    'sid' => intval($requests[$i]['sid']),
                    'cid' => intval($requests[$i]['cid']),
                    'iid' => intval($requests[$i]['iid']),
                    //other attributes
                    'preferred_date_1' => $requests[$i]['preferred_date_1'],
                    'preferred_date_2' => $requests[$i]['preferred_date_2'],
                    'scheduled_date' => $requests[$i]['scheduled_date'], //No longer needed
                    'course_code' => $requests[$i]['course_code'],
                    'additional_requirements' => $requests[$i]['additional_requirements'],
                    'exam_type' => $requests[$i]['exam_type'],
                    'exam_medium' => $requests[$i]['exam_medium'],
                    'computer_required' => $requests[$i]['computer_required'],
                    'student_approval' => $requests[$i]['student_approval'],
                    'student_notes' => $requests[$i]['student_notes'],
                    'center_approval' => $requests[$i]['center_approval'],
                    'center_notes' => $requests[$i]['center_notes'],
                ]
            );
            echo "\n\t- Request ".$requests[$i]['rid'].": S-".$requests[$i]['sid']." to C-".$requests[$i]['cid'].".";
        }
        echo "\n";

        //Unset remaining arrays
        unset($students);
        unset($centers);
        unset($requests);

    }//run

}