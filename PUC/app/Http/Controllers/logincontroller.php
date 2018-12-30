<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class logincontroller extends Controller
{
    public function login(Request $request)
    {
        $request->validate(
            [
                'Username' => 'numeric',
                'Password' => 'min:4',
            ]
            );
        $validating_right_user = DB::table('users')
                ->where('user_id',$request->input('Username'))
                ->where('password',$request->input('Password'))
                ->first();
        if($validating_right_user)
        {
            if($validating_right_user->active == 1)
            {
                Session::put('user_name',$user->user_id);     
                if($user->admin == 1)
                {
                    $user_role_admin = 1;
                    Session::put('admin',$user_role_admin);
                }
                if($user->teacher == 1)
                {
                    $user_role_teacher =1;
                    Session::put('teacher',$user_role_teacher);
                }
                if($user->student == 1)
                {
                    $user_role_student =1;
                    Session::put('student',$user_role_student);
                }
                 return redirect('/dashboard');
                }else
                    return "Sorry, this user is blocked";
        }
        else 
        return redirect('/');
    }
}
