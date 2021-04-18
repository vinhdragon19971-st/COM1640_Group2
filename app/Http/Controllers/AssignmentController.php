<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;

use Carbon\Carbon;
session_start();

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //*************************************** */
    //**********Controller*For*Admin**********
    //*************************************** */
    public function AuthLogin(){
        $user_id = Session::get('user_id');
        if($user_id){
            $role_id = Session::get('user_role');
            if($role_id == 0){
                return Redirect::to('/admin');
            }else{
                return Redirect::to('/login-admin')->send();
        }
        }else{
            return Redirect::to('/login-admin')->send();
        }
    }

    public function view_create_assignment(){
        $this->AuthLogin();
        $course = DB::table('tbl_course')->where('course_status', '1')->orderby('course_name','asc')->get();

        return view('admin.create_assignment')->with('course', $course);
    }

    public function create_assignment(Request $request)
    {
        $this->AuthLogin();
        //insert product
        $data = array();
        $data['asm_name'] = $request->asm_name;
        $data['exp'] = Carbon::parse($request->exp);
        $data['exp2'] = Carbon::parse($request->exp2);
        $data['course_id'] = $request->course_id;
        $data['asm_status'] = $request->asm_status;
        
        $result = DB::table('tbl_asm')->insert($data);
        Session::put('message','Create Assignment Success !!!');
        return Redirect::to('/admin/view-create-assignment');
    }

    public function view_list_assignment()
    {
        $this->AuthLogin();
        //Show all list
        $all_assignment = DB::table('tbl_asm')
                            ->join('tbl_course','tbl_course.course_id','=','tbl_asm.course_id')
                            ->orderby('asm_id','desc')->get();

        return view('admin.list_assignment')->with('all_assignment', $all_assignment);
    }

    public function edit_assignment($asm_id)
    {
        $this->AuthLogin();
        $course = DB::table('tbl_course')->where('course_status', '1')->orderby('course_name','asc')->get();

        $edit_assignment = DB::Table('tbl_asm')->where('asm_id', $asm_id)->get();
        $manager_assignment = view('admin.edit_assignment')->with('edit_assignment', $edit_assignment)
                            ->with('course', $course);

        return view('admin.adminindex')->with('admin.edit_assignment',$manager_assignment);
    }

    public function update_assignment(Request $request, $asm_id)
    {
        $this->AuthLogin();
        //insert product
        $data = array();
        $data['asm_name'] = $request->asm_name;
        $data['exp'] = $request->exp;
        $data['exp2'] = $request->exp2;
        $data['course_id'] = $request->course_id;
        $data['asm_status'] = $request->asm_status;
        
        $result = DB::table('tbl_asm')->where('asm_id', $asm_id)->update($data);
        Session::put('message','Update Assignment Success !!!');
        return Redirect::to('/admin/view-list-assignment');
    }

    public function delete_assignment($asm_id){
        $this->AuthLogin();
        DB::Table('tbl_asm')->where('asm_id', $asm_id)->delete();
        Session::put('message','Delete assignment Success !!!');
        return Redirect::to('/admin/view-list-assignment');
    }

    //*************************************** */
    //**********Controller*For*User**********
    //*************************************** */
    public function View_Assignment($course_id)
    {
        $infor_course = DB::table('tbl_course')->where('course_id', $course_id)->get();
        $assignment = DB::table('tbl_asm')->where('course_id', $course_id)->get();
        
        $user_id = Session::get('user_id');

        $user = DB::Table('tbl_submission')->where('user_id',$user_id)
                                        ->where('course_id',$course_id)->first();

        $exp = DB::table('tbl_asm')->where('course_id',$course_id)->first();

        $checkTime = Carbon::parse($exp->exp);
        
        $checkTime2 = Carbon::parse($exp->exp2);

        $now = Carbon::now();

        if (Carbon::now()->greaterThan($checkTime)){            
            if (Carbon::now()->greaterThan($checkTime2)){
                Session::put('timeup', 'Time Expired !!!');

                return view('Assignment.Assignment')->with('assignment', $assignment)
                                                ->with('infor_course', $infor_course)
                                                ->with('submit',$user);
            }
            $days = $now->diffInDays($checkTime2);
            $hours = $now->copy()->addDays($days)->diffInHours($checkTime2);
            $minutes = $now->copy()->addDays($days)->addHours($hours)->diffInMinutes($checkTime2);
            $seconds = $now->copy()->addDays($days)->addHours($hours)->addMinutes($minutes)->diffInSeconds($checkTime2);
            $timeup = $days.'-Days-'.$hours.':'.$minutes.':'.$seconds.'- Time Just For Resubmit';

            Session::put('timeup', $timeup);

            return view('Assignment.Assignment')->with('assignment', $assignment)
                                                ->with('infor_course', $infor_course)
                                                ->with('submit',$user);
        }else{
            $days = $now->diffInDays($checkTime);
            $hours = $now->copy()->addDays($days)->diffInHours($checkTime);
            $minutes = $now->copy()->addDays($days)->addHours($hours)->diffInMinutes($checkTime);
            $seconds = $now->copy()->addDays($days)->addHours($hours)->addMinutes($minutes)->diffInSeconds($checkTime);
            $timeup = $days.'-Days-'.$hours.':'.$minutes.':'.$seconds;

            Session::put('timeup', $timeup);


            return view('Assignment.Assignment')->with('assignment', $assignment)
                                            ->with('infor_course', $infor_course)
                                            ->with('submit',$user);
        }
    }
}
