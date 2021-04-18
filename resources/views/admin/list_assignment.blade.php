@extends('admin.adminindex')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      List Submit
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
            <th>Submit Name</th>
            <th>Topic Name</th>
            <th>Exp Submit</th>
            <th>Exp2 Submit</th>
            <th>Status</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_assignment as $key => $asm)
          <tr>
            <td>{{ $asm -> asm_name }}</td>
            <td>{{ $asm -> course_name }}</td>
            <td>{{ $asm -> exp }}</td>
            <td>{{ $asm -> exp2 }}</td>
            <td><span class="text-ellipsis">
              <?php
              if($asm->asm_status == 1){
                ?>
                  <h4>Unhide</h4>
                <?php
              }
              else{
                ?>
                  <h4>Hide</h4>
                <?php
              }
              ?>
            </span></td>
            <td>
              <a href="{{URL::to('/admin/edit-assignment/'.$asm->asm_id)}}"
                  class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
            </td>
            <td>
                <a href="{{URL::to('/admin/delete-assignment/'.$asm->asm_id )}}"
                class="active styling-edit" ui-toggle-class=""
                onclick="return confirm('Are you sure to delete topic?')">
                <i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>  
          @endforeach       
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection