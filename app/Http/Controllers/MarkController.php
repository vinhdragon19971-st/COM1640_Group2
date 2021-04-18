<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use PDF;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;

session_start();

class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    public function convertWordToPDF(){

       
        /* Set the PDF Engine Renderer Path */
        $domPdfPath = base_path('vendor/dompdf/dompdf');

       
        Settings::setPdfRendererPath($domPdfPath);
        Settings::setPdfRendererName('DomPDF');
      
        //Load word file
        $Content = IOFactory::load(public_path('news.docx')); 
       
        //Save it into PDF
        $PDFWriter = IOFactory::createWriter($Content,'PDF');
        if ($PDFWriter) {
            $PDFWriter->save(public_path('news.pdf')); 
        }else{
            Session::get('message','Document File just English');
        }
    }
    
    public function View_Mark($course_id)
    {
        $mark = DB::table('tbl_mark')->get();
        $submission = DB::table('tbl_submission')->where('course_id', $course_id)->get();

        return view('Mark.Mark')->with('submission', $submission)->with('mark',$mark);
    }

    public function Details_Mark($submission_id)
    {
        $mark = DB::table('tbl_mark')->where('submission_id', $submission_id)->get();
        
        $submission = DB::table('tbl_submission')->where('submission_id', $submission_id)->get();

        $student = DB::table('tbl_submission')->select('user_id')->where('submission_id', $submission_id)->first();
        
        foreach($student as $value){
            $student_id = $value;
        }

        $course = DB::table('tbl_submission')->select('course_id')->where('submission_id', $submission_id)->first();

        foreach($course as $value){
            $course_id = $value;
        }
        
        $student_infor = DB::table('tbl_user')->where('user_id', $student_id)->get();

        $asm_infor = DB::table('tbl_asm')->where('course_id', $course_id)->get();

        $comment = DB::table('tbl_comment')->where('submission_id', $submission_id)->get();

        $user = DB::Table('tbl_submission')->where('user_id',$student_id)
                                        ->where('course_id',$course_id)->first();
        
        return view('Mark.DetailsMark')->with('submission', $submission)->with('mark',$mark)->with('student', $student_infor)->with('asm', $asm_infor)->with('comment', $comment)->with('submit', $user);
    }

    public function index($course_id)
    {

        $mark = DB::table('tbl_mark')->select('submission_id')->where('mark_status',1)->get();
        
        foreach($mark as $mark){
            $submission_id[]= $mark->submission_id;
        }

        $submission = DB::table('tbl_submission')->where('course_id', $course_id)->whereIn('submission_id', $submission_id)->get();

        return view('Mark.ViewTopMark')->with('submission', $submission);
    }

    public function indextop1($course_id){
        $mark = DB::table('tbl_mark')->select('submission_id')->where('mark_status',1)->orderby('mark','desc')->first();
        
        foreach($mark as $value){
            $submission_id = $value;
        }

        $submission = DB::table('tbl_submission')->where('course_id', $course_id)->where('submission_id', $submission_id)->get();

        return view('Mark.ViewTop1Mark')->with('submission', $submission);
    }

    public function view_mark_student($course_id){
        $user_id = Session::get('user_id');

        $mark = DB::table('tbl_mark')->where('student_id', $user_id)->get();
        $submission = DB::table('tbl_submission')->where('course_id', $course_id)->where('user_id', $user_id)->get();

        $get_submission = DB::table('tbl_submission')->select('submission_id')->where('course_id', $course_id)->where('user_id', $user_id)->first();
        foreach($get_submission as $value){
            $submission_id = $value;
        }

        $comment = DB::table('tbl_comment')->where('submission_id', $submission_id)->get();

        return view('Mark.ViewMarkStudent')->with('submission', $submission)->with('mark',$mark)->with('comment', $comment);
    }

    public function mark_for_submission(Request $request,$submission_id){
        $data = array();
        $value = $request->all();
            $data['student_id'] = $request->student_id;
            $data['coordinator_id'] = $request->coordinator_id;
            $data['submission_id'] = $request->submission_id;
            $data['mark'] = $request->mark_student;
            $data['mark_comment'] = $request->mark_comment;
            $data['mark_status'] = $request->mark_status;
        $submission = DB::table('tbl_mark')->where('submission_id',$submission_id)->take(1)->get();
        if($submission->count()==1){
             $submission = DB::table('tbl_mark')->where('submission_id',$submission_id)->update($data);
        }else{
            $submission = DB::table('tbl_mark')->insert($data);
        }
       
        return redirect()->back();
    }

    public function comment_for_submission(Request $request, $submission_id){
        $data = array();
        $data['submission_id'] = $request->submission_id;
        $data['mark_id'] = $request->mark_id;        
        $user_fullname = Session::get('user_fullname');
        $data['mark_comment'] = $user_fullname.": ".$request->mark_comment2;

        DB::Table('tbl_comment')->insert($data);
        
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function back()
    {
        return back();
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
