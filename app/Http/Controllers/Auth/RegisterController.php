<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Role;
use Eloquent;
use App\Models\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'utype'=>'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     * Assign user type basic on the input
     */
    protected function create(array $data)
    {
        // TODO: This is Not Standard. Need to find alternative
        Eloquent::unguard();
        if($data['utype'] == 'student') {
            $options = [
                'cost' => 10,
                'salt' => str_random(22) //22 required minimum //str_random safe? random_bytes
            ];
            //Acquire initial auto_increment values from database (for students, users, and centers) and then print them.
            $USERS_DEFAULT_AUTO_INCREMENT = 1000000;
            $result = DB::select(DB::raw("SHOW TABLE STATUS LIKE 'users'"));
            $result = json_decode(json_encode($result), true);
            $uid = $result[0]['Auto_increment'];
            if($uid==0){
                DB::update("ALTER TABLE Users AUTO_INCREMENT = ".$USERS_DEFAULT_AUTO_INCREMENT.";");
                $uid = $USERS_DEFAULT_AUTO_INCREMENT;
                echo "Alter user auto increament to ".$USERS_DEFAULT_AUTO_INCREMENT;
            }
            $user = User::create([
//                'name' => $data['name'],
                'email' => $data['email'],
                'uid'=>$uid,
                'password' => password_hash($data['password'], PASSWORD_DEFAULT, $options),
                'salt' => $options['salt'],
                'type' => "student",
            ]);
            DB::insert('insert into students (sid,firstName,age) values (?,?,?)',[$uid,$data['name'],10]);
        }
        else{
            $options = [
                'cost' => 10,
                'salt' => str_random(22) //22 required minimum //str_random safe? random_bytes
            ];
            //Acquire initial auto_increment values from database (for students, users, and centers) and then print them.
            $USERS_DEFAULT_AUTO_INCREMENT = 1000000;
            $result = DB::select(DB::raw("SHOW TABLE STATUS LIKE 'users'"));
            $result = json_decode(json_encode($result), true);
            $uid = $result[0]['Auto_increment'];
            if($uid==0){
                DB::update("ALTER TABLE Users AUTO_INCREMENT = ".$USERS_DEFAULT_AUTO_INCREMENT.";");
                $uid = $USERS_DEFAULT_AUTO_INCREMENT;
                echo "Alter user auto increament to ".$USERS_DEFAULT_AUTO_INCREMENT;
            }
            $user = User::create([
//                'name' => $data['name'],
                'email' => $data['email'],
                'uid'=>$uid,
                'password' => password_hash($data['password'], PASSWORD_DEFAULT, $options),
                'salt' => $options['salt'],
                'type' => "center",
            ]);
            DB::insert('insert into centers (cid,center_name,center_email,cost) values (?,?,?,?)',[$uid,$data['name'],$data['email'],10]);
        }
        $role = Role::where('name', 'SUPER_ADMIN')->first();
        $user->attachRole($role);
    
        return $user;
    }
}
