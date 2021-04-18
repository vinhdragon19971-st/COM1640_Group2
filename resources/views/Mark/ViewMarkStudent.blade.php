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
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($submission as $key => $sm)
          <tr>
            <td>
                @foreach($mark as $key => $m)
                @if($sm->submission_id==$m->submission_id)
                <p>Mark: {{$m->mark}}</p>
            </td>
            <td>
            <p>Feedback</p>
                  <b style="color: black;">{{$m->mark_comment}}</b>
                @endif
                @endforeach
            </td>
            <td>
                <p>Mark Status</p>
                @if($m->mark_status==1)
                    <b>Approve</b>
                @elseif($m->mark_status==0)
                    <b>Not Approve</b>
                @endif
            </td>
          </tr>  
          @endforeach
        </tbody>
      </table>
 
   

    
    </div>
  </div>
 

</div>
<!-- comment -->
<div class="submissionstatustable">
            <h3>Comment</h3>
            <div class="comments">
            @foreach($comment as $key => $cmt)
              <p>{{ $cmt->mark_comment  }}</p>
            @endforeach
            </div>
            <div class="box boxaligncenter submissionsummarytable">
                <table class="generaltable">
                    <tbody>
                        <tr class="lastrow">
                            <th class="cell c0" style="" scope="row">Submission <b>Comments</b></th>
                            <td class="cell c1 lastcol" style="">
                                <div class="box boxaligncenter plugincontentsummary summary_assignsubmission_comments_224587">                        
                                    <div class="mdl-left">
                                        <a class="showcommentsnonjs" href="#">Show comments</a>
                                        <a class="comment-link" id="comment-link-6040dcb9c6a0f" href="#" role="button" aria-expanded="false">
                                            <i class="icon fa fa-caret-right fa-fw " title="Comments" aria-label="Comments"></i>
                                            <span id="comment-link-text-6040dcb9c6a0f">Comments (0)</span>
                                        </a>
                                        <div id="comment-ctrl-6040dcb9c6a0f" class="comment-ctrl">
                                            <ul id="comment-list-6040dcb9c6a0f" class="comment-list">
                                                <li class="first"></li>
                                            </ul>
                                            <div class="comment-area">
                                                <div class="db">

                                                  <!-- Comment Form -->
                                                  @foreach($submission as $key => $sm)
                                                  <form action="{{url('comment-for-submission/'.$sm->submission_id)}}" method="post">
                                                  @csrf
                                                    <input type="hidden" name="submission_id" value="{{$sm->submission_id}}">
                                                    @foreach($mark as $key => $m)
                                                    <input type="hidden" name="mark_id" value="{{$m->mark_id}}">
                                                    @endforeach
                                                    <textarea name="mark_comment2" id="message" class="form-control" name="content" rows="2" id="dlg-content-6040dcb9c6a0f" aria-label="Add a comment..." cols="20" style="color: grey;"></textarea>
                                                    <center><input type="submit" class="btn btn-warning" name="comment" value="Comment"></center>
                                                  </form>
                                                  @endforeach
                                                </div>
                                                <div class="fd" id="comment-action-6040dcb9c6a0f">
                                                    <a id="comment-action-post-6040d cb9c6a0f" class="save-comment" href="#">Save comment</a>
                                                    <span> | </span>
                                                    <a id="comment-action-cancel-6040dcb9c6a0f" class="cancel-comment" href="#">Cancel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>         
        </div>
@endsection