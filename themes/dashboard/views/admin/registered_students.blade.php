@extends('layouts.app')
@section('title','Manage Portal')
@section('content')

    <!-- /.content-header -->
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Portal</h1>
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
                                <th>Name</th>
                                {{-- <th>E-mail</th> --}}
                                <th>Lisence no</th>
                                <th>Mobile</th>
                                <th>password</th>
                                <th>Notes</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($users as $key=>$p )
                               <tr>
                                   <td>{{ $key+1}}</td>
                                   <td>{{ $p['name']}}</td>
                                   <td>{{ $p['license_no']}}</td>
                                   <td>{{ $p['mobile_no']}}</td>
                                   <td>{{ $p['exam']}}</td>
                                   <td>{{ $p['comment']}}</td>
                                   <td>
                                    

                                    <a href="{{ url('admin/manage_students_exam/'.$p['id'])}}" class="btn btn-success btn-sm mb-2">Exam</a></br>

                                    <a href="{{url('admin/edit_students/'.$p['id'])}}" class="btn btn-primary btn-sm">Edit</a>


                                       
                                       <!-- <a href="{{ url('admin/delete_registered_students/'.$p['id'])}}" class="btn btn-danger btn-sm">Delete</a> -->
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
          <h4 class="modal-title">Add Student </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form action="{{ url('/admin/add_new_students')}}" class="database_operation">  
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Enter name</label>
                            {{ csrf_field()}}
                            <input type="text" required="required" name="name" placeholder="Enter name" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                          <label for="">license number</label>
                          {{ csrf_field()}}
                          <input type="text" required="required" name="license_no" placeholder="License No" class="form-control">
                      </div>
                    </div>
                   
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Enter mobile no.</label>
                            {{ csrf_field()}}
                            <input type="text"  name="mobile_no" placeholder="Enter mobile number" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Enter Password</label>
                            {{ csrf_field()}}
                            <input type="password" required="required" name="password" placeholder="Enter password" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                          <div class="form-group">
                                  <label for="">Comments</label>
                                  {{ csrf_field()}}
                                  <textarea name="comment" id="" cols="30" rows="10" class="form-control"></textarea>
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
