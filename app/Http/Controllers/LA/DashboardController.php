<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use View;
use Auth;
use Illuminate\Support\Facades\Redirect;
use App\User;

/**
 * Class DashboardController
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    //users
    public function index()
    {
        return view('la.dashboard');
    }

    public function updateUser($id)
    {

    }

    public function addUser()
    {
        return view('la/addUser');
    }

    public function addU(Request $request){
        $email= $request->input('email');
        $type = $request->input('type');
        $name = $request->input('name');
        $result = DB::select(DB::raw("SHOW TABLE STATUS LIKE 'Users'"));
        $result = json_decode(json_encode($result),true); //LA Workaround. Boolean true for returned as associative array.
        $id = $result[0]['Auto_increment'];
        $options = [
            'cost' => 10,
            'salt' => str_random(22) //22 required minimum //str_random safe? random_bytes
        ];
        if($type == 'student') {
            DB::table('users')->insert(
                [
                    'id' => $id, //!@#here
                    'uid' => $id, //!@#changed to 'uid'
                    'email' => $email,
                    'salt' => $options['salt'],
                    'password' => password_hash('password', PASSWORD_DEFAULT, $options),
                    'type' => $type,
                ]);
        DB::insert('insert into students (sid,firstName,iid,age) values (?,?,?,?)',[$id,$name,10000,10]);
        }
        else {
            DB::table('users')->insert(
                [
                    'id' => $id, //!@#here
                    'uid' => $id, //!@#changed to 'uid'
                    'email' => $email,
                    'salt' => $options['salt'],
                    'password' => password_hash('password', PASSWORD_DEFAULT, $options),
                    'type' => $type,
                ]);
            DB::insert('insert into centers (cid,center_name,center_email,cost) values (?,?,?,?)', [$id, $name, $email, 10]);
        }
        return Redirect::to('/admin');

    }
    public function delUser($id)
    {
        DB::table('users')->where('id', '=', $id)->delete();

        DB::table('students')->where('sid', '=',$id)->delete();
        DB::table('centers')->where('cid', '=', $id)->delete();
        return Redirect::to('/admin');
    }


    //students
    public function students()
    {
        return view('la/students');
    }
    public function updateStud()
    {

    }
    public function addStud()
    {
        return view('la/addStud');
    }

    public function addS(Request $request){
        $fname= $request->input('fname');
        $lname = $request->input('lname');
        $email =$request->input('email');
        $sex = $request->input('sex');
        $age = $request->input('age');
        $phone = $request->input('phone');

        $type = 'student';
        $result = DB::select(DB::raw("SHOW TABLE STATUS LIKE 'Users'"));
        $result = json_decode(json_encode($result),true); //LA Workaround. Boolean true for returned as associative array.
        $id = $result[0]['Auto_increment'];
        $options = [
            'cost' => 10,
            'salt' => str_random(22) //22 required minimum //str_random safe? random_bytes
        ];
            DB::table('users')->insert(
                [
                    'id' => $id, //!@#here
                    'uid' => $id, //!@#changed to 'uid'
                    'email' => $email,
                    'salt' => $options['salt'],
                    'password' => password_hash('password', PASSWORD_DEFAULT, $options),
                    'type' => $type,
                ]);
        DB::table('students')->insert(
            [
                'sid' => $id,
                'firstName' => $fname,
                'lastName' => $lname,
                'iid' => 10000,
                'sex' => $sex,
                'age' => $age,
                'phone' => $phone,
            ]
        );


        return Redirect::to('la/students');

    }

    public function delStud($sid)
    {
        DB::table('students')->where('sid', '=', $sid)->delete();
        DB::table('users')->where('id', '=', $sid)->delete();
        return Redirect::to('la/students');
    }


    //centers
    public function centers()
    {
        return view('la/centers');
    }
    public function updateCen()
    {

    }
    public function addCen()
    {
        return view('la/addCen');
    }

    public function addC(Request $request){
        $cname= $request->input('cname');
        $email =$request->input('email');
        $phone = $request->input('phone');
        $cost =$request->input('cost');

        $type = 'center';
        $result = DB::select(DB::raw("SHOW TABLE STATUS LIKE 'Users'"));
        $result = json_decode(json_encode($result),true); //LA Workaround. Boolean true for returned as associative array.
        $id = $result[0]['Auto_increment'];
        $options = [
            'cost' => 10,
            'salt' => str_random(22) //22 required minimum //str_random safe? random_bytes
        ];
        DB::table('users')->insert(
            [
                'id' => $id, //!@#here
                'uid' => $id, //!@#changed to 'uid'
                'email' => $email,
                'salt' => $options['salt'],
                'password' => password_hash('password', PASSWORD_DEFAULT, $options),
                'type' => $type,
            ]);
        DB::table('centers')->insert(
            [
                'cid' => $id,
                'center_name' => $cname,
                'center_email' => $email,
                'cost' => $cost,
                'phone' => $phone,
            ]
        );


        return Redirect::to('la/centers');

    }

    public function delCen($cid)
    {
        DB::table('centers')->where('id', '=', $cid)->delete();
        DB::table('users')->where('id', '=', $cid)->delete();
        return Redirect::to('la/centers');
    }


    //requests
    public function requests()
    {
        return view('la/requests');
    }
    public function updateReq()
    {

    }

    public function delReq($id)
    {
        DB::table('users')->where('id', '=', $id)->delete();
        return Redirect::to('/admin');
    }
}