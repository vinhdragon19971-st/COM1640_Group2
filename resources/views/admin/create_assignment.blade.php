@extends('admin.adminindex')
@section('admin_content')

        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Create Submission
                        <br>
                        <?php
                            $message = Session::get('message');
                            if($message){
                                echo "<span class='text-alert'>".$message."</span>";
                                Session::put('message', null);
                            }
                        ?>
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form role="form" action="{{URL::to('/admin/create-assignment')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputAssignmentName">Submission</label>
                                <input type="text" name="asm_name" class="form-control" id="exampleInputAssignmentName" placeholder="Input name Assignment...">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputAssignmentExp">Exp Submission</label>
                                <input type="datetime-local" name="exp" class="form-control" id="exampleInputAssignmentExp">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputAssignmentExp">Exp2 Submission</label>
                                <input type="datetime-local" name="exp2" class="form-control" id="exampleInputAssignmentExp">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputCategory">Topic Name</label>
                                <select name="course_id" class="form-control input-sm m-bot15" id="exampleInputCategory">
                                    @foreach($course as $key => $cou){
                                        <option value="{{$cou -> course_id}}">{{$cou -> course_name}}</option>
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
                            <center><button type="submit" name="create_Assignment" class="btn btn-info">Create Submission</button></center>
                        </form>
                        </div>

                    </div>
                </section>
            </div>
        </div>

@endsection