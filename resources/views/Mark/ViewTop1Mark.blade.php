@extends('index')
@section('index_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3>The list of documents has been accepted</h3>
    </div>
    <div class="table-responsive">
      <?php
        $message = Session::get('message');
        if($message){
          echo '<center><span class="text-alert">'.$message.'</span></center>';
          Session::put('Message',null);
        }
      ?>
      <table class="table table-striped b-t b-light">
        <tbody>
          @foreach($submission as $key => $sm)
          <tr>
            <th>File Document</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <?php
							$user_role = Session::get('user_role');
                            $user_id = Session::get('user_id');
							if($user_role == 3){
            ?>
            <th>File Image</th>
            <?php
              }
            ?>
          </tr>
          <tr>
          <td>{{ $sm->submission_file }}</td>
          <?php
            if($user_role == 3){
          ?>            
            <td>
              <a href="{{URL::to('/mark/details-mark/'.$sm->submission_id)}}"
                class="btn btn-primary" ui-toggle-class="">
                Details</a>
            </td>
          <?php
            }
          ?>
           <!-- Button trigger modal -->
              <td>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Preview
              </button>
              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" style="width:98%;" role="document">
                  <div class="modal-content " style="background: none">
                    
                    <div class="modal-body">
                       <iframe src ="{{ asset('public/laraview/#../'.$sm->pdf_review) }}" width="1000px" height="600px"></iframe>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                </div>
              </div>
            </td>
            <?php
							$user_role = Session::get('user_role');
                            $user_id = Session::get('user_id');
							if($user_role == 3){
            ?>
            <td>
                <a href="{{asset('public/uploads/submit/'.$sm->submission_file)}}"
                class="btn btn-primary" ui-toggle-class="">
                Download</a>
            </td>
            <td>
            <td><a href="{{asset('public/uploads/submit/'.$sm->image_file)}}"  target="_blank"><img src="{{asset('public/uploads/submit/'.$sm->image_file)}}" alt="Nothing Img" height="100" width="100" ></a></td>
            <?php
              }
            ?>
          </tr>  
          @endforeach
        </tbody>
      </table> 
    </div>
  </div>
</div>
<div class="submissionstatustable">
  <center><a class="btn btn-dark" href="{{ url()->previous() }}"> ⬅ Back</a></center>
</div>
@endsection