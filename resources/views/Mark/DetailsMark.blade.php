@extends('index')

@php
    if (is_null($submit)){
       $submission_id = -1;
    } else {
        $submission_id = $submit->submission_id;
    }

    
@endphp

@push('css')
  <style>
    .comments{
      margin-left:50px;
    }
      .comment-detail-user{
        font-size: 12px;
        color: red;
      }
      .comment-detail-content{
        font-size: 22px;
      }
  </style>
@endpush

@section('index_content')
<div class="table-agile-info">
  <div class="panel panel-default">
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
            <th>File Report</th>
            <th>File Image</th>
            <th>Submission Name</th>
            <th>Student Fullname</th>
          </tr>
        </thead>
        <tbody>
          @foreach($submission as $key => $sm)
          <tr>
            <td><a href="#">{{ $sm-> submission_file}}</a></td>
            <td><img src="{{asset('public/uploads/submit/'.$sm->image_file)}}" alt="Nothing Img" height="100" width="100"></td>
            @foreach($asm as $key => $asm)
            <td>{{ $asm-> asm_name }}</td>
            @endforeach
            @foreach($student as $key => $std)
            <td>{{ $std-> user_fullname }}</td>
            @endforeach
          </tr>
          <form action="{{url('mark-for-submission/'.$sm->submission_id)}}" method="post">

                @csrf
                <input type="hidden" name="student_id" value="{{$sm->user_id}}">
                <input type="hidden" name="coordinator_id" value="{{Session::get('user_id')}}">
                <input type="hidden" name="submission_id" value="{{$sm->submission_id}}">
                <tr>
                <td>
                  @foreach($mark as $key => $m)
                    @if($sm->submission_id==$m->submission_id)
                  <p><b style="color: black; font-size: 20px;">Mark: </b>{{$m->mark}}</p>
                  <p></p>
                  <p><b style="color: black; font-size: 20px;">Feedback: </b>{{$m->mark_comment}}</p>
                    @endif
                    <p><b style="color: black; font-size: 20px;">Mark Status: </b>
                  <?php
                    if($m->mark_status == 1){
                      ?>
                        <b>Approve</b>
                      <?php
                    }
                    else{
                      ?>
                         <b>Not Approve</b>
                      <?php
                        }                        
                      ?>
                  </p>
                </td>
                @endforeach
                <td>
                <?php
                  $user_role = Session::get('user_role');
                                $user_id = Session::get('user_id');
                  if($user_role == 2){
                ?>
                <select name="mark_status" class="form-control m-bot15" id="exampleInputStatus">                                    
                    <option value="0">Not Approve</option>
                    <option value="1">Approve</option>
                </select> 
                </td>
                <td>
                  <p>Feedback for submission</p>
                  <textarea name="mark_comment" style="resize: none;padding: 5px" rows="5"></textarea>
                </td>
                
                <td>
                  <p>Mark for Submission</p>
                  <input type="number" min="0" name="mark_student" max="10" min="0" step="0.1">
                </td>
                <?php
                  }
                ?>
                </tr>
                <tr style="float: left !important; margin-left: 550px; !important;">
                  <th>
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
                    <?php
                      if($user_role == 2){
                    ?>
                    <input type="submit" class="btn btn-warning" name="mark" value="Mark">
                    <?php
                      }
                    ?>
                  </th>
                </tr>
              </form>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
          <!-- comment -->
          <div class="submissionstatustable">
            <h3>Comment</h3>
            <div class="comments2">
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
                                                    <textarea name="mark_comment2" id="message2" class="form-control" name="content2" rows="2" id="dlg-content-6040dcb9c6a0f" aria-label="Add a comment..." cols="20" style="color: grey;"></textarea>
                                                    <center><input type="submit" class="btn btn-warning" name="comment2" value="Comment2"></center>
                                                  </form>
                                                  @endforeach
                                                </div>
                                                <div class="fd" id="comment-action-6040dcb9c6a0f">
                                                    <a id="comment-action-post-6040d cb9c6a0f" class="save-comment2" href="#">Save comment</a>
                                                    <span> | </span>
                                                    <a id="comment-action-cancel-6040dcb9c6a0f" class="cancel-comment2" href="#">Cancel</a>
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
        <!-- End Comment -->

        <!-- Chat -->
        <div class="submissionstatustable">
            <h3>Chat with Student</h3>
            <div class="comments">               
               </div>
            <div class="box boxaligncenter submissionsummarytable">
                <table class="generaltable">
                    <tbody>
                        <tr class="lastrow">
                            <th class="cell c0" style="" scope="row"></th>
                            <td class="cell c1 lastcol" style="">
                                <div class="box boxaligncenter plugincontentsummary summary_assignsubmission_comments_224587">                        
                                    <div class="mdl-left">
                                        <a class="showcommentsnonjs" href="#"></a>
                                        <a class="comment-link" id="comment-link-6040dcb9c6a0f" href="#" role="button" aria-expanded="false">                                            
                                            <span id="comment-link-text-6040dcb9c6a0f"></span>
                                        </a>
                                        <div id="comment-ctrl-6040dcb9c6a0f" class="comment-ctrl">
                                            <ul id="comment-list-6040dcb9c6a0f" class="comment-list">
                                                <li class="first"></li>
                                            </ul>
                                            <div class="comment-area">
                                                <div class="db">
                                                    <input id="message" class="form-control" name="content" rows="2" id="dlg-content-6040dcb9c6a0f" aria-label="Add a comment..." cols="20" style="color: grey;">
                                                </div>
                                                <div class="fd" id="comment-action-6040dcb9c6a0f">
                                                <i class="icon fa fa-caret-right fa-fw " title="Comments" aria-label="Comments"></i><a id="comment-action-post-6040d cb9c6a0f" class="save-comment" href="#">Send Message</a>
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
        <!-- End Chat -->
<div class="submissionstatustable">
  <center><a class="btn btn-dark" href="{{ url()->previous() }}"> ⬅ Back</a></center>
</div>

@endsection


@push('js')
<script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-database.js"></script>

  <!-- TODO: Add SDKs for Firebase products that you want to use
       https://firebase.google.com/docs/web/setup#available-libraries -->
  <script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-analytics.js"></script>
  
  <script>
    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    var firebaseConfig = {
      apiKey: "AIzaSyDHK6w0w5xobQi4ubXEcgmQXKxuraMr400",
      authDomain: "project-42d35.firebaseapp.com",
      databaseURL: "https://project-42d35-default-rtdb.firebaseio.com",
      projectId: "project-42d35",
      storageBucket: "project-42d35.appspot.com",
      messagingSenderId: "383196165088",
      appId: "1:383196165088:web:8fee0d9d8745be240db185",
      measurementId: "G-RE90PGDG3H"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    firebase.analytics();
  </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>

    const submission_id = JSON.parse(`{!! $submission_id !!}`);
    const user_id = `{!!session('user_id') !!}`;
  
  const database = firebase.database();


  function handle(messages)
  {
      const key = database.ref('messages').push().key;

      database.ref('messages').child(key).set({
        user_id,
        submission_id,
        content: messages, 
        'created_at': new Date().toString(),
      })

  } 

  const input = document.querySelector('#message');
  const saveCommentElement = document.querySelector('.save-comment');
  const cancelCommentElement = document.querySelector('.cancel-comment');


  database.ref('messages').orderByChild('submission_id').equalTo(submission_id).on('value',snapshot => {
    const data = snapshot.val();

    let id = new Set();

    for(let item in data){
        id.add(data[item].user_id);
    } 
    
    id = [...id];

    axios.post(`/phivinh/users`,{
      data: id,
    })
    .then(response => {
      const users = response.data;

      
      const findUser = id => {
        id = parseInt(id);
        return users.find(user => user.user_id === id).user_fullname;
      }


      let str= ' ';
      for(let item in data){
        const component = `
        <div class="comment-detail">
                  <div class="comment-detail-user">${findUser(data[item].user_id)}</div>
                  <div class="comment-detail-content">${data[item].content}</div>
                </div>`;

                str += component;
    }

    document.querySelector('.comments').innerHTML = str;

    })
    .catch(err => console.log(err));


  
  })


  input.onkeypress = function(event){
    if (event.keyCode !== 13) return;

    handle(event.target.value);
    input.value = '';
  }

  saveCommentElement.onclick = function(event) {
    event.preventDefault();
    handle(input.value)
    input.value = '';
  }
  

</script>
@endpush