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
            $employee = Employee::create([
                'name' => $data['name'],
                'designation' => "Super Admin",
                'mobile' => "8888888888",
                'mobile2' => "",
                'email' => $data['email'],
                'gender' => 'Male',
                'dept' => "1",
                'city' => "Pune",
                'address' => "Karve nagar, Pune 411030",
                'about' => "About user / biography",
                'date_birth' => date("Y-m-d"),
                'date_hire' => date("Y-m-d"),
                'date_left' => date("Y-m-d"),
                'salary_cur' => 0,
            ]);

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'context_id' => $employee->id,
                'type' => "student",
            ]);
        }
        else{
            $employee = Employee::create([
                'name' => $data['name'],
                'designation' => "center",
                'mobile' => "8888888888",
                'mobile2' => "",
                'email' => $data['email'],
                'gender' => 'Male',
                'dept' => "1",
                'city' => "Pune",
                'address' => "Karve nagar, Pune 411030",
                'about' => "About user / biography",
                'date_birth' => date("Y-m-d"),
                'date_hire' => date("Y-m-d"),
                'date_left' => date("Y-m-d"),
                'salary_cur' => 0,
            ]);

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'context_id' => $employee->id,
                'type' => "center",
            ]);
        }
        $role = Role::where('name', 'SUPER_ADMIN')->first();
        $user->attachRole($role);
    
        return $user;
    }
}
