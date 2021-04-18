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
    <section id="region-main" class="col-12">
        <span class="notifications" id="user-notifications"></span>
        <center><h1  id="!">Submit Assignment</h1></center>
        <div class="submissionstatustable">
            <h3>Submission status</h3>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif            
            @if(session('failed'))
            <div class="alert alert-danger">
                {{ session('failed')}}
            </div>
            @endif
            <div class="box boxaligncenter submissionsummarytable">            
                <table class="generaltable">
                @if(!is_null($submit))
                    @foreach($infor_course as $key => $icou)
                    <form action="{{URL::to('/assignment/submission/edit/'.$icou->course_id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                        <tbody>                        
                            <input type="hidden" name="user_id" value="<?php
                                        $user_id = Session::get('user_id');
                                        echo $user_id;
                                    ?>">
                            <tr class="">
                                <th class="cell c0" style="" scope="row">Course Name:</th>                            
                                <td class="cell c1 lastcol" style="">{{ $icou -> course_name }}</td>
                                <input type="hidden" name="course_id" value="{{ $icou -> course_id }}">  
                                <input type="hidden" name="course_name" value="{{ $icou -> course_name }}">                            
                            </tr>
                            @foreach($assignment as $key => $asm)
                            <tr class="">
                                <th class="cell c0" style="" scope="row">Submit Name:</th>
                                <td class="cell c1 lastcol" name="asm_name" style="">{{ $asm -> asm_name }}</td>
                                <input type="hidden" name="asm_name" value="{{ $asm -> asm_name }}">
                            </tr>
                            <tr class="">
                                <th class="cell c0" style="" scope="row">Status Submission:</th>
                                <?php
                                    if($asm->asm_status == 1){
                                ?>
                                <td class="submissionnotgraded cell c1 lastcol" value="1" style="">The submission has not expired yet</td>
                                <?php
                                    }else{
                                ?>
                                <td class="submissionnotgraded cell c1 lastcol" value="0" style="">Deadline for submission</td>
                                <?php
                                    }
                                ?>
                            </tr>
                            <tr class="">
                                <th class="cell c0" style="" scope="row">Exp date:</th>
                                <td class="cell c1 lastcol" style="">{{ $asm -> exp }}</td>
                            </tr>
                            <tr class="">
                                <th class="cell c0" style="" scope="row">Time remaining:</th>
                                <td class="cell c1 lastcol" style="">
                                    <?php
                                        $timeup = Session::get('timeup');
                                        echo '<span style="color: red; font-size: 20px">' .$timeup. '</span>';
                                    ?>
                                </td>
                            </tr>
                            <tr class="">
                                <th class="cell c0" style="" scope="row" id="submission_file">File submissions For Report:</th>
                                <td class="cell c1 lastcol" style="">
                                    <input type="file" name="submission_file_uploads" id="submission_file" accept=".doc,.docx"> |
                                    <a href="#!">{{ $submit->submission_file }}</a>
                                </td>                        
                            </tr>
                            <tr class="">
                                <th class="cell c0" style="" scope="row" id="image_file">File submissions (For Image):</th>
                                <td class="cell c1 lastcol" style="">
                                    <input type="file" name="image_file" id="image_file" accept=".jpg,.png"> | <img src="{{asset('public/uploads/submit/'.$submit->image_file)}}" height="100" width="100">
                                </td>                        
                            </tr>
                            @endforeach
                            <center><button type="submit" class="btn btn-secondary" id="single_button6040dcb9b437233" title="">Resubmission</button></center>
                        </tbody>                    
                    </form>
                    @endforeach
                @else
                @foreach($infor_course as $key => $icou)
                    <form action="{{URL::to('/assignment/submission/'.$icou->course_id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                        <tbody>                        
                            <input type="hidden" name="user_id" value="<?php
                                        $user_id = Session::get('user_id');
                                        echo $user_id;
                                    ?>">
                            <tr class="">
                                <th class="cell c0" style="" scope="row">Course Name:</th>                            
                                <td class="cell c1 lastcol" style="">{{ $icou -> course_name }}</td>
                                <input type="hidden" name="course_id" value="{{ $icou -> course_id }}">  
                                <input type="hidden" name="course_name" value="{{ $icou -> course_name }}">                            
                            </tr>
                            @foreach($assignment as $key => $asm)
                            <tr class="">
                                <th class="cell c0" style="" scope="row">Submit Name:</th>
                                <td class="cell c1 lastcol" name="asm_name" style="">{{ $asm -> asm_name }}</td>
                                <input type="hidden" name="asm_name" value="{{ $asm -> asm_name }}">
                            </tr>
                            <tr class="">
                                <th class="cell c0" style="" scope="row">Status Submission:</th>
                                <?php
                                    if($asm->asm_status == 1){
                                ?>
                                <td class="submissionnotgraded cell c1 lastcol" value="1" style="">The submission has not expired yet</td>
                                <?php
                                    }else{
                                ?>
                                <td class="submissionnotgraded cell c1 lastcol" value="0" style="">Deadline for submission</td>
                                <?php
                                    }
                                ?>
                            </tr>
                            <tr class="">
                                <th class="cell c0" style="" scope="row">Exp date:</th>
                                <td class="cell c1 lastcol" style="">{{ $asm -> exp }}</td>
                            </tr>
                            <tr class="">
                                <th class="cell c0" style="" scope="row">Time remaining:</th>
                                <td class="cell c1 lastcol" style="">
                                <?php
                                        $timeup = Session::get('timeup');
                                        echo '<span style="color: red; font-size: 20px">' .$timeup. '</span>';
                                    ?>
                                </td>
                            </tr>
                            <tr class="">
                                <th class="cell c0" style="" scope="row" id="submission_file">File submissions (For Report):</th>
                                <td class="cell c1 lastcol" style="">
                                    <input type="file" name="submission_file_uploads" id="submission_file_uploads" accept=".doc,.docx">
                                </td>                        
                            </tr>
                            <tr class="">
                                <th class="cell c0" style="" scope="row" id="image_file">File submissions (For Image):</th>
                                <td class="cell c1 lastcol" style="">
                                    <input type="file" name="image_file" id="image_file" accept=".jpg,.png">
                                </td>                        
                            </tr>
                            @endforeach
                            <center><button type="submit" class="btn btn-secondary" id="single_button6040dcb9b437233" title="">Add submission</button></center>
                        </tbody>
                    </form>
                    @endforeach                    
                @endif
                </table>                
            </div>
            @foreach($infor_course as $key => $icou)
                <center><a href="{{URL::to('/view-mark-student/'.$icou->course_id)}}" class="btn btn-primary">View Mark</a></center>
            @endforeach
        </div>
        @if(!is_null($submit))
        <div class="submissionstatustable">
            <h3>Chat with Coordinator</h3>
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
        @endif
    </section> 
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