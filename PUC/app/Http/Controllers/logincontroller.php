<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class logincontroller extends Controller
{

    public function login(Request $request)
    {
        // $request->validate(
        //     [
        //         'Username' => 'numeric',
        //         'Password' => 'min:4',
        //     ]
        //     );
        $validating_right_user = DB::table('users')
                ->where('user_id',$request->input('Username'))
                ->where('password',$request->input('Password'))
                ->first();
        if($validating_right_user)
        {
            if($validating_right_user->active == 1)
            {
                Session::put('user_id',$validating_right_user->user_id);     
                if($validating_right_user->admin == 1)
                {
                    $user_role_admin = 1;
                    Session::put('admin',$user_role_admin);
                }
                if($validating_right_user->teacher == 1)
                {
                    $user_role_teacher =1;
                    Session::put('teacher',$user_role_teacher);
                }
                if($validating_right_user->student == 1)
                {
                    $user_role_student =1;
                    Session::put('student',$user_role_student);
                }
                $advisor = DB::table('sections')->where('advisor_id',$request->input('Username'))->first();
                if($advisor)
                {
                    $user_role_advisor =1;
                    Session::put('advisor',$user_role_advisor);
                }
                 return redirect('/dashboard');
                }else
                    return "Sorry, this user is blocked";
        }
        else 
        return redirect('/');
    }
    public function logout()
    {
        Session::flush();
        return redirect('/');
    }
}
