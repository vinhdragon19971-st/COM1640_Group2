<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
session_start();

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *ca
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

    public function view_create_course(){
        $this->AuthLogin();
        $category = DB::table('tbl_category')->orderby('category_name','asc')->get();

        return view('admin.create_course')->with('category', $category);
    }

    public function create_course(Request $request)
    {
        $this->AuthLogin();
        //insert product
        $data = array();
        $data['course_name'] = $request->course_name;
        $data['category_id'] = $request->category_id;
        $data['course_des'] = $request->course_des;
        $data['course_status'] = $request->course_status;
        $data['course_image'] = $request->user_image;
        $get_image = $request->file('course_image');
    

        if($get_image){
            //Get Name Image
            $get_name_image = $get_image->getClientOriginalName();
            //Currenr = final '.'
            //Split string Name - Get Name not ".jpg" - based on the sign '.'
            $name_image = current(explode('.', $get_name_image));
            //Make copies
            $time = Carbon::now()->format('Y');
            $new_image = $name_image.mt_rand().$time
                        .'.'.$get_image->getClientOriginalExtension();
            //Move to folder
            $get_image->move('public/uploads/course', $new_image);
            
            $data['course_image'] = $new_image;

            DB::Table('tbl_course')->insert($data);
            Session::put('message','Create Course Success !!!');
            return Redirect::to('/admin/view-create-course');
        }
        else{
            $data['course_image'] = '';

            DB::Table('tbl_course')->insert($data);
            Session::put('message','Create Course Success but no Image !!!');
            return Redirect::to('/admin/view-create-course');
        }
    }

    public function view_list_course()
    {
        $this->AuthLogin();
        //Show all list
        $all_course = DB::Table('tbl_course')
                        ->join('tbl_category','tbl_category.category_id','=','tbl_course.category_id')
                        ->orderby('course_id','desc')->get();
        
        return view('admin.list_course')->with('all_course',$all_course);
    }
    
    public function edit_course($course_id)
    {
        $this->AuthLogin();
        $category = DB::table('tbl_category')->orderby('category_name','asc')->get();

        $edit_course = DB::Table('tbl_course')->where('course_id', $course_id)->get();
        $manager_course = view('admin.edit_course')->with('edit_course', $edit_course)
                            ->with('category', $category);

        return view('admin.adminindex')->with('admin.edit_course',$manager_course);
    }

    public function update_course(Request $request, $course_id)
    {
        $this->AuthLogin();
        //insert product
        $data = array();
        $data['course_name'] = $request->course_name;
        $data['course_des'] = $request->course_des;
        $data['course_status'] = $request->course_status;
        $data['course_image'] = $request->course_image;
        $get_image = $request->file('course_image');
        
        if($get_image){
            //Get Name Image
            $get_name_image = $get_image->getClientOriginalName();
            //Currenr = final '.'
            //Split string Name - Get Name not .jpg - based on the sign '.'
            $name_image = current(explode('.', $get_name_image));
            //Make copies
            $new_image = $name_image.mt_rand().date_default_timezone_get()
                        .'.'.$get_image->getClientOriginalExtension();
            //Move to folder
            $get_image->move('public/uploads/course', $new_image);
            //closing down
            $data['course_image'] = $new_image;

            DB::Table('tbl_course')->where('course_id', $course_id)->update($data);
            Session::put('message','Edit Course Success !!!');
            return Redirect::to('/admin/view-list-course');
        }else{
            $data['course_image'] = '';
            
            DB::Table('tbl_course')->where('course_id', $Course_id)->update($data);
            Session::put('message','Edit Course Success but not Image !!!');
            return Redirect::to('/admin/view-list-course');
        }        
    }

    public function delete_course($course_id){
        $this->AuthLogin();
        DB::Table('tbl_course')->where('course_id', $course_id)->delete();
        Session::put('message','Delete Course Success !!!');
        return Redirect::to('/admin/view-list-course');
    }

    //*************************************** */
    //**********Controller*For*User**********
    //*************************************** */

    public function Course_of_Category()
    {
        $all_category = DB::Table('tbl_category')->orderby('category_id','desc')->get();

        return view('Category.Category')->with('all_category',$all_category);
    }

    public function Show_Course_of_Category($category_id)
    {
        $all_course = DB::Table('tbl_course')->where('category_id', $category_id)
                                            ->orderby('course_id','desc')->get();

        return view('Course.Course')->with('all_course',$all_course);
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
}
