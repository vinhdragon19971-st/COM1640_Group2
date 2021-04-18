<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class AdminController extends Controller
{
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->AuthLogin();
        return view('admin.adminindex');
    }

    public function login_admin()
    {        
        return view('admin.checkout_admin');
    }

    public function admin_checkout(Request $request){
        $email = $request->user_email;
        $password = md5($request->user_password);

        $result = DB::Table('tbl_user')->where('user_email', $email)
                                    ->where('user_password', $password)->first();

        if($result){
            $role = $result->user_role;
            echo $role;
            if($role == 0){
                Session::put('user_id', $result->user_id);
                Session::put('user_fullname', $result->user_fullname);
                Session::put('user_image', $result->user_image);
                Session::put('user_role', $role);
                return Redirect::to('/admin');                
            }else{
                Session::put('message','You not admin !');
                return Redirect::to('/login-admin');
            }            
        }else{
            Session::put('message','Username or Password is wrong, input again !');
            return Redirect::to('/login-admin');
        }
    }

    public function logout_admin()
    {
        $this->AuthLogin();
        //cho id + name user role admin thành null
        Session::put('user_fullname', null);
        Session::put('user_id', null);
        return Redirect::to('/login-admin'); 
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
