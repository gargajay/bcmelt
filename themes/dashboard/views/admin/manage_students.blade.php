@extends('layouts.app')
@section('title','Dashboard')
@section('content')

    <!-- /.content-header -->
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Students</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage Exam</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <!-- Default box -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Title</h3>
  
                  <div class="card-tools">
                        <a class="btn btn-info btn-sm" href="javascript:;" data-toggle="modal" data-target="#myModal">Add new</a>
                  </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Exam</th>
                                <th>Exam Date</th>
                                <th>Result</th>
                                <th>status</th>
                                <!-- <th>Actions</th> -->
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($students as $key=>$std)
                              <tr>
                                  <td>{{ $key+1}}</td>
                                  <td>{{ $std['ex_name']}}</td>
                                  <td>{{ $std['exam_date']}}</td>
                                  <td>
                                    <?php 
                                    if($std['exam_joined']==1){
                                    ?>
                                          <a href="{{url('admin/admin_view_result/'.$std['user_exam_id'])}}" class="btn btn-info btn-sm">View result</a>
                                    <?php    
                                    }
                                    ?>


                                  </td>
                                  <td><input type="checkbox" class="student_status" data-id="{{ $std['id']}}" data-stid="{{ $student_id}}" <?php if($std['std_status']==1){ echo "checked";} ?> name="status"></td>
                                  <td>
                                      <!-- <a href="{{url('admin/edit_students/'.$std['user_exam_id'])}}" class="btn btn-primary1">Edit</a>
                                      <a href="{{url('admin/delete_students/'.$std['user_exam_id']."/".$student_id)}}" class="btn btn-danger btn-sm">Delete</a> -->
                                  </td>
                              </tr>
                          @endforeach
                        </tbody>
                        <tfoot>
                            
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
      </section>
    </div>
    <!-- /.content-header -->

    <!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add new Exam</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form action="{{ url('admin/add_new_student_exam')}}" class="database_operation1" method="POST">  

            <input type="hidden" name="student_id" value="{{$student_id}}">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Select Exam</label>
                            {{ csrf_field()}}
                            <select name="exam_id[]" id="" class="form-control" multiple>
                              @forelse($exams as $key => $value)
                                <option value="{{$value['id']}}">{{$value['title']}}</option>
                              @empty
                                
                              @endforelse
                            </select>
                        </div>
                    </div>
                  
                    
                    
                  
                    <div class="col-sm-12">
                        <div class="form-group">
                            <button class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </div>
            </form>
      </div>
      
    </div>
</div>	


 
@endsection
