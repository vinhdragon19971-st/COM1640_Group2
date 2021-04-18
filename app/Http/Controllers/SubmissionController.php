<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use PDF;
session_start();

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Submission(Request $request, $course_id)
    {
        $exp = DB::table('tbl_asm')->where('course_id',$course_id)->first();

        $checkTime = Carbon::parse($exp->exp);

        $now = Carbon::now();

        if (Carbon::now()->greaterThan($checkTime)){
            return redirect()->back()->with('failed','Deadline for ubmission');
        }

        $validator_report = Validator::make($request->all(),[
            'submission_file_uploads' => 'required|mimes:docx,doc',
        ]);

        $validator_image = Validator::make($request->all(),[
            'image_file' => 'required|mimes:jpg,png',
        ]);

        if ($validator_report->fails()) return redirect()->back()->withErrors($validator_report->errors());


        $data = array();
        $data['user_id'] = $request->user_id;
        $data['course_id'] = $request->course_id;
        $data['course_name'] = $request->course_name;
        $data['asm_name'] = $request->asm_name;

     
        $data['image_file'] = $request->submission_file;

        $get_file = $request->file('submission_file_uploads');
        $get_image = $request->file('image_file');

        if($get_file){

            //Get Name Image
            $get_name_file = $get_file->getClientOriginalName();
            //Currenr = final '.'
            //Split string Name - Get Name not ".jpg" - based on the sign '.'
            $name_file = current(explode('.', $get_name_file));
            //Make copies   
            $time = Carbon::now()->format('Y');         
            $new_file = $name_file.mt_rand().$time
                        .'.'.$get_file->getClientOriginalExtension();

            //Move to folder
            $get_file->move('public/uploads/submit', $new_file);

                // echo $name_file.'.'.$get_file->getClientOriginalExtension();
               /* Set the PDF Engine Renderer Path */
                $domPdfPath = base_path('vendor/dompdf/dompdf');

               
                \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
                \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');
                
                //Load word file
                $Content = \PhpOffice\PhpWord\IOFactory::load(public_path('uploads/submit/'.$new_file)); 
                
                $pdf_namefile = $name_file.rand(0,9999);
                //Save it into PDF
                $PDFWriter = \PhpOffice\PhpWord\IOFactory::createWriter($Content,'PDF');
                $PDFWriter->save(public_path($pdf_namefile.'.pdf')); 

               //  //closing down
                $data['submission_file'] = $new_file;

                $data['pdf_review'] = $pdf_namefile.'.pdf';

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
                $get_image->move('public/uploads/submit', $new_image);
                //closing down
                $data['image_file'] = $new_image;
                
                DB::Table('tbl_submission')->insert($data);
               

                Session::put('message','Submission Success !!!');
                return Redirect::to('/assignment/'.$course_id);
            }else{
                $data['image_file'] = '';
                
                DB::Table('tbl_submission')->insert($data);
                Session::put('message','Submission Success !!!');
                return Redirect::to('/assignment/'.$course_id);
            }            
        }
        else{
            dd($get_image);
        }
    }

    public function UpateSubmission(Request $request, $course_id)
    {
        //Get Database
        $exp = DB::table('tbl_asm')->where('course_id',$course_id)->first();
        //Get Exp time and Parse
        $checkTime = Carbon::parse($exp->exp);

        $checkTime2 = Carbon::parse($exp->exp2);
        //Get Time Now
        $now = Carbon::now();
        //Compare Time
        if (Carbon::now()->greaterThan($checkTime2)){
            return redirect()->back()->with('failed','Deadline for Submission');
        }


        $validator = Validator::make($request->all(),[
            'submission_file_uploads' => 'required|mimes:docx,doc',
        ]);

        if ($validator->fails()) return redirect()->back()->withErrors($validator->errors());

        $user_id = Session::get('user_id');

        $data = array();
        $data['user_id'] = $request->user_id;
        $data['course_id'] = $request->course_id;
        $data['course_name'] = $request->course_name;
        $data['asm_name'] = $request->asm_name;
        
        $data['image_file'] = $request->submission_file;
        $get_file = $request->file('submission_file_uploads');
        $get_image = $request->file('image_file');

        if($get_file){
            //Get Name Image
            $get_name_file = $get_file->getClientOriginalName();
            //Currenr = final '.'
            //Split string Name - Get Name not ".jpg" - based on the sign '.'
            $name_file = current(explode('.', $get_name_file));
            //Make copies
            $time = Carbon::now()->format('Y');
            // $new_file = $name_file.mt_rand().date_default_timezone_get()
            //             .'.'.$get_file->getClientOriginalExtension();
            $new_file = $name_file.mt_rand().$time
                        .'.'.$get_file->getClientOriginalExtension();
            //Move to folder
            $get_file->move('public/uploads/submit', $new_file);
             // echo $name_file.'.'.$get_file->getClientOriginalExtension();
               /* Set the PDF Engine Renderer Path */
                $domPdfPath = base_path('vendor/dompdf/dompdf');

               
                \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
                \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');
                
                //Load word file
                $Content = \PhpOffice\PhpWord\IOFactory::load(public_path('uploads/submit/'.$new_file)); 
                
                $pdf_namefile = $name_file.rand(0,9999);
                //Save it into PDF
                $PDFWriter = \PhpOffice\PhpWord\IOFactory::createWriter($Content,'PDF');
                $PDFWriter->save(public_path($pdf_namefile.'.pdf')); 

               //  //closing down
                $data['submission_file'] = $new_file;

                $data['pdf_review'] = $pdf_namefile.'.pdf';
            //closing down
            $data['submission_file'] = $new_file;

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
                $get_image->move('public/uploads/submit', $new_image);
                //closing down
                $data['image_file'] = $new_image;
    
                DB::Table('tbl_submission')->where('course_id', $course_id)->where('user_id', $user_id)->update($data);
                Session::put('message','Submission Success !!!');
                return Redirect::to('/assignment/'.$course_id);
            }else{
                $data['image_file'] = '';
                
                DB::Table('tbl_submission')->where('course_id', $course_id)->where('user_id', $user_id)->update($data);
                Session::put('message','Submission Success !!!');
                return Redirect::to('/assignment/'.$course_id);
            }            
        }
        else{
            dd($get_image);
        }
    }

    public function index()
    {
        //
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
