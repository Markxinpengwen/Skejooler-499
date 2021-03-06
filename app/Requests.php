<?php

/**
 * Author: Barrett Sharpe, Brett Schaad
 */

namespace App;

class Requests extends BaseModel
{
    // sets table and primary key for database access, and sets timestamps to be updated
    protected $table = "requests";
    protected $primaryKey = "rid";
    public $timestamps = true;

    // validation rules array
    protected $rules = array(
        'id' => 'numeric',
        'rid' => 'numeric',
        'sid' => 'numeric',
        'cid' => 'numeric',
        'iid' => 'numeric',
        'preferred_date_1' => '', // must be in the future or the same
        'preferred_date_2' => '', // must be in the future or the same
        'scheduled_date' => '', // must be in the future or the same
        'course_code' => 'string',
        'additional_requirements' => 'string',
        'exam_type' => 'string',
        'exam_medium' => 'string',
        'computer_required' => 'string',
        'student_approval' => 'numeric',
        'student_notes' => 'string',
        'center_approval' => 'numeric',
        'center_notes' => 'string',
    );

    // decision array for approval status logic (2=approved, 1= undecided, 0=denied)
    private $decision = array(
        //Level 1: Changed Date Schema. [0] = No; [1] = yes
        //No Date Change
        0 => array(
            //Level 2: DB Value. Integers. Note: 2 represents 0,2 in the decisions table.
            22 => array(
                //Level 3: Form Values. Integers, same behaviour as Level 2
                22 => array(
                    //Level 4: Results. Array of two integers: [0] = center, [1] = student.
                    0 => 2,
                    1 => 2
                ),
                21 => array(
                    0 => 8,
                    1 => 8
                ),
                20 => array(
                    0 => 8,
                    1 => 8
                ),
                12 => array(
                    0 => 1,
                    1 => 2
                ),
                11 => array(
                    0 => 8,
                    1 => 8
                ),
                10 => array(
                    0 => 8,
                    1 => 8
                ),
                2 => array(
                    0 => 0,
                    1 => 1
                ),
                1 => array(
                    0 => 8,
                    1 => 8
                ),
                0 => array(
                    0 => 8,
                    1 => 8
                )
            ),
            21 => array(
                22 => array(
                    0 => 8,
                    1 => 8
                ),
                21 => array(
                    0 => 2,
                    1 => 1
                ),
                20 => array(
                    0 => 8,
                    1 => 8
                ),
                12 => array(
                    0 => 8,
                    1 => 8
                ),
                11 => array(
                    0 => 2,
                    1 => 1
                ),
                10 => array(
                    0 => 8,
                    1 => 8
                ),
                2 => array(
                    0 => 8,
                    1 => 8
                ),
                1 => array(
                    0 => 0,
                    1 => 1
                ),
                0 => array(
                    0 => 8,
                    1 => 8
                )
            ),
            20 => array(
                22 => array(
                    0 => 8,
                    1 => 8
                ),
                21 => array(
                    0 => 8,
                    1 => 8
                ),
                20 => array(
                    0 => 8,
                    1 => 8
                ),
                12 => array(
                    0 => 8,
                    1 => 8
                ),
                11 => array(
                    0 => 8,
                    1 => 8
                ),
                10 => array(
                    0 => 8,
                    1 => 8
                ),
                2 => array(
                    0 => 8,
                    1 => 8
                ),
                1 => array(
                    0 => 8,
                    1 => 8
                ),
                0 => array(
                    0 => 8,
                    1 => 8
                )
            ),
            12 => array(
                22 => array(
                    0 => 2,
                    1 => 2
                ),
                21 => array(
                    0 => 8,
                    1 => 8
                ),
                20 => array(
                    0 => 8,
                    1 => 8
                ),
                12 => array(
                    0 => 1,
                    1 => 2
                ),
                11 => array(
                    0 => 8,
                    1 => 8
                ),
                10 => array(
                    0 => 8,
                    1 => 8
                ),
                2 => array(
                    0 => 0,
                    1 => 1
                ),
                1 => array(
                    0 => 8,
                    1 => 8
                ),
                0 => array(
                    0 => 8,
                    1 => 8
                )
            ),
            11 => array(
                22 => array(
                    0 => 8,
                    1 => 8
                ),
                21 => array(
                    0 => 8,
                    1 => 8
                ),
                20 => array(
                    0 => 8,
                    1 => 8
                ),
                12 => array(
                    0 => 8,
                    1 => 8
                ),
                11 => array(
                    0 => 8,
                    1 => 8
                ),
                10 => array(
                    0 => 8,
                    1 => 8
                ),
                2 => array(
                    0 => 8,
                    1 => 8
                ),
                1 => array(
                    0 => 8,
                    1 => 8
                ),
                0 => array(
                    0 => 8,
                    1 => 8
                )
            ),
            10 => array(
                22 => array(
                    0 => 8,
                    1 => 8
                ),
                21 => array(
                    0 => 8,
                    1 => 8
                ),
                20 => array(
                    0 => 3,
                    1 => 3
                ),
                12 => array(
                    0 => 8,
                    1 => 8
                ),
                11 => array(
                    0 => 8,
                    1 => 8
                ),
                10 => array(
                    0 => 1,
                    1 => 0
                ),
                2 => array(
                    0 => 8,
                    1 => 8
                ),
                1 => array(
                    0 => 8,
                    1 => 8
                ),
                0 => array(
                    0 => 4,
                    1 => 4
                )
            ),
            2 => array(
                22 => array(
                    0 => 8,
                    1 => 8
                ),
                21 => array(
                    0 => 8,
                    1 => 8
                ),
                20 => array(
                    0 => 8,
                    1 => 8
                ),
                12 => array(
                    0 => 8,
                    1 => 8
                ),
                11 => array(
                    0 => 8,
                    1 => 8
                ),
                10 => array(
                    0 => 8,
                    1 => 8
                ),
                2 => array(
                    0 => 8,
                    1 => 8
                ),
                1 => array(
                    0 => 8,
                    1 => 8
                ),
                0 => array(
                    0 => 8,
                    1 => 8
                )
            ),
            1 => array(
                22 => array(
                    0 => 8,
                    1 => 8
                ),
                21 => array(
                    0 => 2,
                    1 => 1
                ),
                20 => array(
                    0 => 8,
                    1 => 8
                ),
                12 => array(
                    0 => 8,
                    1 => 8
                ),
                11 => array(
                    0 => 0,
                    1 => 1
                ),
                10 => array(
                    0 => 8,
                    1 => 8
                ),
                2 => array(
                    0 => 8,
                    1 => 8
                ),
                1 => array(
                    0 => 0,
                    1 => 1
                ),
                0 => array(
                    0 => 8,
                    1 => 8
                )
            ),
            0 => array(
                22 => array(
                    0 => 8,
                    1 => 8
                ),
                21 => array(
                    0 => 8,
                    1 => 8
                ),
                20 => array(
                    0 => 8,
                    1 => 8
                ),
                12 => array(
                    0 => 8,
                    1 => 8
                ),
                11 => array(
                    0 => 8,
                    1 => 8
                ),
                10 => array(
                    0 => 8,
                    1 => 8
                ),
                2 => array(
                    0 => 8,
                    1 => 8
                ),
                1 => array(
                    0 => 8,
                    1 => 8
                ),
                0 => array(
                    0 => 8,
                    1 => 8
                )
            )
        ),

        //Yes Date Change
        1 => array(
            //Level 2: DB Value. Integers. Note: 2 represents 0,2 in the decisions table.
            22 => array(
                //Level 3: Form Values. Integers, same behaviour as Level 2
                22 => array(
                    //Level 4: Results. Array of two integers: [0] = center, [1] = student.
                    // Integers:
                    // - 8: Unspecified
                    // - 4: DELETE
                    // - 3: DNE
                    // - 2
                    // - 1
                    // - 0

                    0 => 2,
                    1 => 1
                ),
                21 => array(
                    0 => 8,
                    1 => 8
                ),
                20 => array(
                    0 => 8,
                    1 => 8
                ),
                12 => array(
                    0 => 2,
                    1 => 1
                ),
                11 => array(
                    0 => 8,
                    1 => 8
                ),
                10 => array(
                    0 => 8,
                    1 => 8
                ),
                2 => array(
                    0 => 0,
                    1 => 1
                ),
                1 => array(
                    0 => 8,
                    1 => 8
                ),
                0 => array(
                    0 => 8,
                    1 => 8
                )
            ),
            21 => array(
                22 => array(
                    0 => 8,
                    1 => 8
                ),
                21 => array(
                    0 => 2,
                    1 => 1
                ),
                20 => array(
                    0 => 8,
                    1 => 8
                ),
                12 => array(
                    0 => 8,
                    1 => 8
                ),
                11 => array(
                    0 => 2,
                    1 => 1
                ),
                10 => array(
                    0 => 8,
                    1 => 8
                ),
                2 => array(
                    0 => 8,
                    1 => 8
                ),
                1 => array(
                    0 => 0,
                    1 => 1
                ),
                0 => array(
                    0 => 8,
                    1 => 8
                )
            ),
            20 => array(
                22 => array(
                    0 => 8,
                    1 => 8
                ),
                21 => array(
                    0 => 8,
                    1 => 8
                ),
                20 => array(
                    0 => 8,
                    1 => 8
                ),
                12 => array(
                    0 => 8,
                    1 => 8
                ),
                11 => array(
                    0 => 8,
                    1 => 8
                ),
                10 => array(
                    0 => 8,
                    1 => 8
                ),
                2 => array(
                    0 => 8,
                    1 => 8
                ),
                1 => array(
                    0 => 8,
                    1 => 8
                ),
                0 => array(
                    0 => 8,
                    1 => 8
                )
            ),
            12 => array(
                22 => array(
                    0 => 2,
                    1 => 1
                ),
                21 => array(
                    0 => 8,
                    1 => 8
                ),
                20 => array(
                    0 => 8,
                    1 => 8
                ),
                12 => array(
                    0 => 2,
                    1 => 1
                ),
                11 => array(
                    0 => 8,
                    1 => 8
                ),
                10 => array(
                    0 => 8,
                    1 => 8
                ),
                2 => array(
                    0 => 0,
                    1 => 1
                ),
                1 => array(
                    0 => 8,
                    1 => 8
                ),
                0 => array(
                    0 => 8,
                    1 => 8
                )
            ),
            11 => array(
                22 => array(
                    0 => 8,
                    1 => 8
                ),
                21 => array(
                    0 => 8,
                    1 => 8
                ),
                20 => array(
                    0 => 8,
                    1 => 8
                ),
                12 => array(
                    0 => 8,
                    1 => 8
                ),
                11 => array(
                    0 => 8,
                    1 => 8
                ),
                10 => array(
                    0 => 8,
                    1 => 8
                ),
                2 => array(
                    0 => 8,
                    1 => 8
                ),
                1 => array(
                    0 => 8,
                    1 => 8
                ),
                0 => array(
                    0 => 8,
                    1 => 8
                )
            ),
            10 => array(
                22 => array(
                    0 => 8,
                    1 => 8
                ),
                21 => array(
                    0 => 8,
                    1 => 8
                ),
                20 => array(
                    0 => 2,
                    1 => 1
                ),
                12 => array(
                    0 => 8,
                    1 => 8
                ),
                11 => array(
                    0 => 8,
                    1 => 8
                ),
                10 => array(
                    0 => 2,
                    1 => 1
                ),
                2 => array(
                    0 => 8,
                    1 => 8
                ),
                1 => array(
                    0 => 8,
                    1 => 8
                ),
                0 => array(
                    0 => 4,
                    1 => 4
                )
            ),
            2 => array(
                22 => array(
                    0 => 8,
                    1 => 8
                ),
                21 => array(
                    0 => 8,
                    1 => 8
                ),
                20 => array(
                    0 => 8,
                    1 => 8
                ),
                12 => array(
                    0 => 8,
                    1 => 8
                ),
                11 => array(
                    0 => 8,
                    1 => 8
                ),
                10 => array(
                    0 => 8,
                    1 => 8
                ),
                2 => array(
                    0 => 8,
                    1 => 8
                ),
                1 => array(
                    0 => 8,
                    1 => 8
                ),
                0 => array(
                    0 => 8,
                    1 => 8
                )
            ),
            1 => array(
                22 => array(
                    0 => 8,
                    1 => 8
                ),
                21 => array(
                    0 => 2,
                    1 => 1
                ),
                20 => array(
                    0 => 8,
                    1 => 8
                ),
                12 => array(
                    0 => 8,
                    1 => 8
                ),
                11 => array(
                    0 => 2,
                    1 => 1
                ),
                10 => array(
                    0 => 8,
                    1 => 8
                ),
                2 => array(
                    0 => 8,
                    1 => 8
                ),
                1 => array(
                    0 => 0,
                    1 => 1
                ),
                0 => array(
                    0 => 8,
                    1 => 8
                )
            ),
            0 => array(
                22 => array(
                    0 => 8,
                    1 => 8
                ),
                21 => array(
                    0 => 8,
                    1 => 8
                ),
                20 => array(
                    0 => 8,
                    1 => 8
                ),
                12 => array(
                    0 => 8,
                    1 => 8
                ),
                11 => array(
                    0 => 8,
                    1 => 8
                ),
                10 => array(
                    0 => 8,
                    1 => 8
                ),
                2 => array(
                    0 => 8,
                    1 => 8
                ),
                1 => array(
                    0 => 8,
                    1 => 8
                ),
                0 => array(
                    0 => 8,
                    1 => 8
                )
            )
        )
    );

    /**
     * Create custom error messages
     * @return array
     */
    public function messages()
    {
        return [
            '' => '',
        ];
    }

    /**
     * Function to return an array of decision integers related to the input condition integers.
     * -    Values: (0) Denied, (1) Unseen, (2) Accepted, (3) DNE, (4) DELETE, (8) Unspecified Action
     * @param $dateChanged
     * @param $database
     * @param $form
     * @return array(int curr user approval, int other user approval)
     * @example receiving array[1,2] is the case where the center_approval should be set to 1, and the student_approval should be set to 2. or vice versa
     */
    public function decision($dateChanged, $database, $form)
    {
        return $this->decision[$dateChanged][$database][$form];
    }

    /**
     * Request model's relational schema
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function centers()
    {
        return $this->hasMany('requests');
    }
}
