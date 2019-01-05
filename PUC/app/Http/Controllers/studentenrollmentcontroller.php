<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class studentenrollmentcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('student.studentenrollment');
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
    public function showsubjects_ajax($id)
    {
        $semester_id = DB::table('sections')->where('id',$id)->first();
        $datas = DB::table('subjects')
            ->where('semester_id',$semester_id->semester_id)
            ->get();
        $data['name'] = $semester_id->name;
        $data['section_id'] = $semester_id->id;
        $data['data'] = $datas;
        return $data;
    }

    public function studentshowpending_ajax()
    {
        if(Session::has('student'))
        {
            $data['redirect']=false;
            $active_session = DB::table('sessions')->where('active',1)->first();
            $datas =DB::table('sessiondatas')
                ->join('subjects','subjects.id','=','sessiondatas.subject_id')
                ->join('semesters','semesters.id','=','sessiondatas.semester_id')
                ->join('sections','sections.id','=','sessiondatas.section_id')
                ->where('sessiondatas.session_id',$active_session->id)
                ->where('sessiondatas.student_id',Session::get('user_id'))
                ->where('sessiondatas.pending',0)
                ->select('subjects.name as subname','semesters.name as semname','subjects.code','subjects.credit','sessiondatas.id','sessiondatas.type','sections.name as secname')
                ->get();

                if(count($datas)>0)
                {
                    $semester_id = DB::table('user_sections')
                                ->join('sections','sections.id','user_sections.section_id')
                                ->join('semesters','semesters.id','sections.semester_id')
                                ->pluck('semesters.id')->first();
                    $cost = DB::table('credit_values')->where('semester_id',$semester_id)->first();
                    $data['cost'] = $cost;
                    $data['nodata'] = false;
                    $data['data'] = $datas;
                }
                else
                {
                    $data['nodata'] = true;
                    $data['user'] = Session::get('user_id');
                }
        }
        else
        {
            $data['redirect']=true;
          
        }
        return $data;
    }

    public function showapproved_ajax()
    {
        if(Session::has('student'))
        {
            $data['redirect']=false;
            $active_session = DB::table('sessions')->where('active',1)->first();
            $datas =DB::table('sessiondatas')
                ->where('session_id',$active_session->id)
                ->where('student_id',Session::get('user_id'))
                ->where('pending',1)
                ->join('subjects','subjects.id','=','sessiondatas.subject_id')
                ->join('semesters','semesters.id','=','sessiondatas.semester_id')
                ->select('subjects.name as subname','semesters.name as semname','subjects.code','subjects.credit')
                ->get();

            if(count($datas)>0)
            {
                $semester_id = DB::table('user_sections')
                ->join('sections','sections.id','user_sections.section_id')
                ->join('semesters','semesters.id','sections.semester_id')
                ->pluck('semesters.id')->first();
                $cost = DB::table('credit_values')->where('semester_id',$semester_id)->first();
                $data['cost'] = $cost;
                $data['data'] = $datas;
                $data['nodata'] = false;
            }
            else
            {
                $data['nodata'] = true;
            }   
            
        }
        else
        {
            $data['redirect']=true;
          
        }
        return $data;
    }


    public function deletepending_ajax($id)
    {
        DB::table('sessiondatas')
            ->where('id',$id)
            ->delete();
        $data['delete'] = true;

        return $data;
    }

    public function postenroll_ajax(Request $request)
    {
        $subject_id = $request->subjects_id; //array
        $type = $request->type; //array
        $section = $request->section;
        $user_id = Session::get('user_id');
        $failed = array();
        $count_helper=0;

        $active_session = DB::table('sessions')->where('active',1)->first();

        if($active_session)
        {
            $data['nosession'] = false;
            $max_student = DB::table('max_students')->where('section_id',$section)->pluck('max_student')->first();
            $total_student = DB::table('sessiondatas')->where('session_id',$active_session->id)->where('section_id',$section)->count();
            
            if($total_student<$max_student)
            {
                $data['max'] = false;
                for($i=0;$i<count($subject_id);$i++)
                {
                    $sname = DB::table('subjects')->where('id',$subject_id[$i])->first();
                    $subject_exist_for_this_session = DB::table('sessiondatas')->where('student_id',$user_id)->where('subject_id',$subject_id[$i])->where('session_id',$active_session->id)->first();
                    
                    if($subject_exist_for_this_session)
                    {
                        $sub_name = DB::table('subjects')->where('id',$subject_id[$i])->first();
                        $failed[$count_helper] = $sub_name->name.' has already enrolled for you.';
                        $count_helper++;
                        $data['success'] = false;
                    }
                    else
                    {
                            $prereq = DB::table('pre_reqs')->where('subject_id',$subject_id[$i])->pluck('prerequisite_subject_id')->first();
                            if($prereq)
                            {
                                $completed_prereq = DB::table('sessiondatas')->where('student_id',$user_id)->where('subject_id',$prereq)->pluck('cgpa')->first();
                                if($completed_prereq>0)
                                {
                                    //GOOD... ELIGIBLE TO ENROLL
                                }
                                else
                                {
                                    $subject_name = DB::table('subjects')->where('id',$subject_id[$i])->first();
                                    $pre_req_subject_name = DB::table('subjects')->where('id',$prereq)->first();
                                    $failed[$count_helper] = $subject_name->name.' has pre-requisite '.$pre_req_subject_name->name.' ';
                                    $count_helper++;
                                    $data['success'] = false;
                                }
                            }
                            else
                            {
                                //PREREQUISITE NA THAKLE DO NOTHING
                            }

                            if($type[$i] == 0)
                            {
                                $exist_subject = DB::table('sessiondatas')->where('subject_id',$subject_id[$i])->where('student_id',$user_id)->first();

                                if($exist_subject)
                                {
                                    $failed[$count_helper] = 'Cant take '.$sname->name.' as retake or recourse. Its already taken once.';
                                    $count_helper++;
                                    $data['success'] = false;
                                }
                                else
                                {
                                    //nothing
                                }
                            }
                            else if($type[$i] == 1)
                            {
                                $exist_subject = DB::table('sessiondatas')->where('subject_id',$subject_id[$i])->where('student_id',$user_id)->first();
                                if($exist_subject)
                                {
                                    $retake_count = DB::table('user_retakes')->where('student_id',$user_id)->where('subject_id',$subject_id[$i])->count();

                                    if($retake_count <4)
                                    {
                                        //EVERYTHING GOOD.. CAN  RETAKE
                                    }
                                    else
                                    {
                                        $failed[$count_helper] = 'You cant take '.$sname->name.' as retake. 3rd Attempt is over.';
                                        $count_helper++;
                                        $data['success'] = false;
                                    }
                                }
                                else
                                {
                                    $failed[$count_helper] = 'You havnt taken '.$sname->name.' previously. So enroll "Regular" For this subject';
                                    $count_helper++;
                                    $data['success'] = false;
                                }
                            }
                            else
                            {
                                $exist_subject = DB::table('sessiondatas')->where('subject_id',$subject_id[$i])->where('student_id',$user_id)->first();
                                if($exist_subject)
                                {
                                    //EVERYTHING GOOD CAN RECOURSE
                                }
                                else
                                {
                                    $failed[$count_helper] = 'You havnt taken '.$sname->name.' previously. So enroll "Regular" For this subject';
                                    $count_helper++;
                                    $data['success'] = false;
                                }
                            }
                    }
                }


                if(count($failed)==0)
                {
                    $semester_id = DB::table('sections')->where('id',$section)->pluck('semester_id')->first();
                    for($i=0;$i<count($subject_id);$i++)
                    {
                        DB::table('sessiondatas')->insert(
                            [
                                'student_id' => $user_id,
                                'subject_id' => $subject_id[$i],
                                'section_id' => $section,
                                'semester_id'=> $semester_id,
                                'type'       => $type[$i],
                                'session_id' => $active_session->id,
                                'pending'    => 0,
                                'attendance' => Null,
                                'rora'       => Null,
                                'ct'         => Null,
                                'mid'        => Null,
                                'final'      => Null,
                                'grade'      => Null,
                                'cgpa'       => Null,
                            ]
                        );
                    }
                    $user_section = DB::table('sessiondatas')
                            ->join('sections','sessiondatas.section_id','=','sections.id')
                            ->where('sessiondatas.student_id',$user_id)
                            ->where('sessiondatas.session_id',$active_session->id)
                            ->orderBy('sections.name','dsc')
                            ->select('sections.id')
                            ->first();
                    $exist_user = DB::table('user_sections')
                            ->where('user_id',$user_id)
                            ->first();
                    if($exist_user)
                    {
                        DB::table('user_sections')
                            ->where('id',$exist_user->id)
                            ->update(['section_id' => $user_section->id]);
                    }
                    else
                    {
                        DB::table('user_sections')->insert(
                            [
                                'user_id' => $user_id,
                                'section_id' => $user_section->id,
                            ]
                        );
                    }
                    $data['section_id'] = $user_section;
                    $data['success'] = true;
                   
                }
            }
            else
            {
                $data['max'] = true;
            }
        }
        else
        {
            $data['nosession'] = true;
        }
        $data['failed'] = $failed;
        return $data;
    }
   
}
