<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class adminsessioncontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.adminsession');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function overview_ajax()
    {
        $sessions = DB::table('sessions')
            ->orderBy('id','dsc')
            ->get();
        $total_student = array();
        for($i=0;$i<count($sessions);$i++) //COUNTING TOTAL STUDENT FOR EACH SESSION
        {
            $total_student[$i] = DB::table('sessiondatas')
                                    ->where('session_id',$sessions[$i]->id)
                                    ->count();
        }
        if(count($sessions)>0)
        {
            $data['sessionhasdata'] = true;
            $data['sessions'] = $sessions;
            $data['totalstudent'] = $total_student;
        }
        else
            $data['sessionhasdata'] = false;

        return $data;
    }

    public function blockunblock_ajax($id,$todo, Request $request)
    {
        if($todo == 0)
        {
            DB::table('sessions')
                ->where('id',$id)
                ->update(['active' =>0]);
            $data['blockunblock']= true;
        }
        elseif($todo == 1)
        {
            DB::table('sessions')
                ->where('active',1)
                ->update(['active' => 0]);
            DB::table('sessions')
                ->where('id',$id)
                ->update(['active' =>1]);
            $data['blockunblock']= true;
        }
        return $data;
    }

    public function deletemodal_ajax($id)
    {
        $datas = DB::table('sessions')
            ->where('id',$id)
            ->get();
        $data['session'] = $datas;
        return $data;
    }

    public function deletesession_ajax($id)
    {
        
        DB::table('sessions')
            ->where('id',$id)
            ->delete();
        $data['delete'] = true;
        return $data;
    }

    public function showsemestersandteachers_ajax()
    {
        $semesters = DB::table('semesters')
            ->where('active',1)
            ->orderBy('name','asc')
            ->get();
        $teachers = DB::table('users')
            ->where('active',1)
            ->where('teacher',1)
            ->get();
        if(count($semesters)>0)
        {
            $data['semesterhasdata'] =true;
            $data['semesters'] = $semesters;
        }
        else
        {
            $data['semesterhasdata'] =false;
        }
        if(count($teachers)>0)
        {
            $data['teacherhasdata'] =true;
            $data['teachers'] = $teachers;
        }
        else
        {
            $data['teacherhasdata'] =false;
        }

        return $data;
    }

    public function save_section_ajax(Request $request)
    {
        $semester = $request->input('semester');
        $section_name = $request->input('section_name');
        $advisor    = $request->input('advisor');
        $active_session =DB::table('sessions')->where('active',1)->first();
        if($active_session)
        {
            $data['nosession'] = false;
            $exist =DB::table('sections')
                ->where('semester_id',$semester)
                ->where('name',$section_name)
                ->first();
        if($exist)
        {
            $exist_all =DB::table('sections')
                    ->where('semester_id',$semester)
                    ->where('name',$section_name)
                    ->where('advisor_id',$advisor)
                    ->where('session_id',$active_session->id)
                    ->first();
            if($exist_all)
            {
                $data['insert'] = false;
            }
            else
            {
                DB::table('sections')
                    ->where('id',$exist->id)
                    ->update(['advisor_id' => $advisor,'session_id' => $active_session->id]);
                $data['insert'] = true;
            }
        }
        else
        {
            DB::table('sections')->insert(
                [
                    'name' => $section_name,
                    'session_id' => $active_session->id,
                    'advisor_id' => $advisor,
                    'semester_id' => $semester
                ]
                );
                $data['insert'] = true;
        }
    }
    else
    {
        $data['nosession'] = true;
    }
    return $data;
}
}
