@extends('index')
@section('index_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3>List Document</h3>
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
        <thead>
          <tr>
            <th>List Submission</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($submission as $key => $sm)
          <tr>
            <td>{{ $sm->submission_file}}</td>
            <td>
                  @foreach($mark as $key => $m)
                    @if($sm->submission_id==$m->submission_id)
                  <p>Mark: {{$m->mark}}</p>
                  <p></p>
                  <p>Comment</p>
                  <b style="color: black;">{{$m->mark_comment}}</b>
                    @endif
                  @endforeach
                </td>   
            <td>
              <a href="{{URL::to('/mark/details-mark/'.$sm->submission_id)}}"
                class="btn btn-primary" ui-toggle-class="">
                Details</a>
            </td>
            <td>
           <!-- Button trigger modal -->
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
            <td>
                <a href="{{asset('public/uploads/submit/'.$sm->submission_file)}}"
                class="btn btn-warning" ui-toggle-class="">
                Download</a>
            </td>
            <style type="text/css">
              div#toolbarRight {
                display: none;
            }
            </style>
            <td>
              
            </td>
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