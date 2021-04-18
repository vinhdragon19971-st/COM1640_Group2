<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
session_start();

class CategoryController extends Controller
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

    public function view_create_category(){
        $this -> AuthLogin();
        return view('admin.create_category');
    }

    public function create_category(Request $request)
    {
        $this->AuthLogin();
        //insert product
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_des'] = $request->category_des;
        $data['category_status'] = $request->category_status;
        $data['category_image'] = $request->category_image;
        $get_image = $request->file('category_image');
        
        if($get_image){
            //Get Name Image
            $get_name_image = $get_image->getClientOriginalName();
            //Currenr = final '.'
            //Split string Name - Get Name not .jpg - based on the sign '.'
            $name_image = current(explode('.', $get_name_image));
            //Make copies
            $time = Carbon::now()->format('Y');
            $new_image = $name_image.mt_rand().$time
                        .'.'.$get_image->getClientOriginalExtension();
            //Move to folder
            $get_image->move('public/uploads/category', $new_image);
            //closing down
            $data['category_image'] = $new_image;

            DB::Table('tbl_category')->insert($data);
            Session::put('message','Create Category Success !!!');
            return Redirect::to('/admin/view-create-category');
        }
        else{
            $data['category_image'] = '';

            DB::Table('tbl_category')->insert($data);
            Session::put('message','Create User Success but no Image !!!');
            return Redirect::to('/admin/view-create-category');
        }
    }

    public function update_category(Request $request, $category_id)
    {
        $this -> AuthLogin();
        //insert product
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_des'] = $request->category_des;
        $data['category_status'] = $request->category_status;
        $data['category_image'] = $request->category_image;
        $get_image = $request->file('category_image');
        
        if($get_image){
            //Get Name Image
            $get_name_image = $get_image->getClientOriginalName();
            //Currenr = final '.'
            //Split string Name - Get Name not .jpg - based on the sign '.'
            $name_image = current(explode('.', $get_name_image));
            //Make copies
            $time = Carbon::now()->format('Y');
            $new_image = $name_image.mt_rand().$time
                        .'.'.$get_image->getClientOriginalExtension();
            //Move to folder
            $get_image->move('public/uploads/category', $new_image);
            //closing down
            $data['category_image'] = $new_image;

            DB::Table('tbl_category')->where('category_id', $category_id)->update($data);
            Session::put('message','Edit Category Success !!!');
            return Redirect::to('/admin/view-list-category');
        }else{
            $data['category_image'] = '';
            
            DB::Table('tbl_category')->where('category_id', $category_id)->update($data);
            Session::put('message','Edit Category Success but not Image !!!');
            return Redirect::to('/admin/view-list-category');
        }        
    }

    public function view_list_category()
    {
        $this -> AuthLogin();
        //Show all list
        $all_category = DB::Table('tbl_category')->orderby('category_id','desc')->get();
        
        return view('admin.list_category')->with('all_category',$all_category);
    }

    public function edit_category($category_id)
    {
        $this -> AuthLogin();
        $edit_category = DB::Table('tbl_category')->where('category_id', $category_id)->get();

        return view('admin.edit_category')->with('edit_category',$edit_category);
    }

    public function delete_category($category_id){
        $this -> AuthLogin();
        DB::Table('tbl_category')->where('category_id', $category_id)->delete();
        Session::put('message','Delete Category Success !!!');
        return Redirect::to('/admin/view-list-category');
    }

    //*************************************** */
    //**********Controller*For*User**********
    //*************************************** */

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
