@extends('admin.adminindex')
@section('admin_content')

        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Edit Submit
                        <br>
                        <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">' .$message. '</span>';
                                Session::put('message', null);
                            }
                        ?>                      
                    </header>                    
                    <div class="panel-body">                        
                        <div class="position-center">
                        <p></p>
                            @foreach($edit_assignment as $key => $asm)
                            <form role="form" action="{{URL::to('/admin/update-assignment/'.$asm->asm_id)}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputName">Submit Name</label>
                                <input type="text" name="asm_name" class="form-control" 
                                        id="exampleInputName" value="{{$asm->asm_name}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputExp">Exp Submit</label>
                                <input type="datetime-local" name="exp" class="form-control" id="exampleInputExp">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputExp">Exp2 Submit</label>
                                <input type="datetime-local" name="exp2" class="form-control" id="exampleInputExp">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputcourse">Course Name</label>
                                <select name="course_id" class="form-control input-sm m-bot15" id="exampleInputcourse">
                                    @foreach($course as $key => $cou){
                                        @if($cou->course_id==$asm->course_id)
                                            <option selected value="{{$cou -> course_id}}">{{$cou -> course_name}}</option>
                                        @else
                                            <option value="{{$cou -> course_id}}">{{$cou -> course_name}}</option>
                                        @endif
                                    }
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputStatus">Status</label>
                                <select name="asm_status" class="form-control input-sm m-bot15" id="exampleInputStatus">
                                    <option value="1">Unhide</option>
                                    <option value="0">Hide</option>
                                </select>
                            </div>
                            <center><button type="submit" name="edit_asm" class="btn btn-info">Edit Submission</button></center>
                        </form>
                        @endforeach
                        </div>

                    </div>
                </section>
            </div>
        </div>

@endsection