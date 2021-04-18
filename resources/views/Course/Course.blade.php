@extends('index')
@section('index_content')
    <div class="container">
        <center><h1>Topic</h1></center>
        <div class="row">
        @foreach($all_course as $key => $cou)            
            <div class="col-sm-4 spacetop">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{asset('public/uploads/course/'.$cou->course_image)}}" alt="course_IMG" class="img-source"  />
                            <h2>{{ $cou -> course_name }}</h2>
                            <p class="shownameproduct">{{ $cou -> course_des }}</p>
                            <?php
							$user_role = Session::get('user_role');
                            $user_id = Session::get('user_id');
							if($user_role == 1){
                            ?>
                                <center><a href="{{URL::to('/assignment/'.$cou->course_id)}}" class="btn btn-primary" style="margin-bottom: 5px;"><p>Submit for Topic</p></a></center>
                            <?php
                                }else if($user_role == 2){
                            ?>
                                <center><a href="{{URL::to('/mark/'.$cou->course_id)}}" class="btn btn-primary" style="margin-bottom: 5px;">Mark</a></center>
                            <?php
                                }else if($user_role == 3){
                            ?>
                                <center><a href="{{URL::to('/view/top-1-mark/'.$cou->course_id)}}" class="btn btn-primary" style="margin-bottom: 5px;">View Top 1 Document</a></center>
                                <center><a href="{{URL::to('/view/top-mark/'.$cou->course_id)}}" class="btn btn-primary" style="margin-bottom: 5px;">View Document Apporve</a></center>
                            <?php
                                }else if($user_role == 4){
                            ?>
                                 <center><a href="{{URL::to('/view/top-mark/'.$cou->course_id)}}" class="btn btn-primary" style="margin-bottom: 5px;">View Document Apporve</a></center>
                            <?php
                                }else{
                            ?>
                                <center><a href="#dropdownMenu1"><i class="fa fa-lock"></i><p style="font-size: 20px; color: red; border-style: dotted solid;">Login to Submit</p></a></center>
                            <?php
                                }
                            ?>                            
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
    <div class="submissionstatustable">
  <center><a class="btn btn-dark" href="{{URL::to('/course-of-category')}}"> ⬅ Back</a></center>
</div>
@endsection