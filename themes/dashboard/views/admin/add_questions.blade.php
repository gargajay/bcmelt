@extends('layouts.app')
@section('title','Add Questions')
@section('content')

    <!-- /.content-header -->
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add questions</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add questions</li>
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
                        <a class="btn btn-info btn-sm" href="javascript:;" data-toggle="modal" data-target="#importModal">Import Question</a>
                  </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Question</th>
                                <th>option1</th>
                                <th>option2</th>
                                <th>option3</th>
                                <th>option4</th>
                                <th>ans</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($questions as $key=>$question)
                              <tr>
                                  <td>{{ $key+1}}</td>
                                  <td>{{ $question['questions']}}</td>
                                  <td>{{ $question['eoption1']}}</td>
                                  <td>{{ $question['eoption2']}}</td>
                                  <td>{{ $question['eoption3']}}</td>
                                  <td>{{ $question['eoption4']}}</td>
                                 
                                  <td>{{ $question['ans']}}</td>
                                  <td> {{$question['category']}}</td>
                                  <td>
                                      {{-- <a href="{{ url('admin/update_question/'. $question['id'])}}" class="btn btn-primary btn-sm">Update</a> --}}
                                      <a href="{{ url('admin/delete_question/'. $question['id'])}}" class="btn btn-danger btn-sm">Delete</a>
                                  </td>
                              </tr>
                          @endforeach
                        </tbody>
                        
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



    {{-- // import model --}}

    <div class="modal fade" id="importModal" role="dialog">
      <div class="modal-dialog modal-md">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Import Question from Excel</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
           

              <form action="{{ url('admin/question-import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                    <div class="custom-file text-left">
                        <input type="file" name="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
                <button class="btn btn-primary">Import data</button>
            </form>
        </div>
        
      </div>
      </div>	


   

    <!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add new Question</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form action="{{ url('/admin/add_new_question')}}" class="database_operation1" enctype="multipart/form-data" method="POST">  
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Enter Question</label>
                            {{ csrf_field()}}
                            <input type="text" required="required" name="question" placeholder="Enter Question" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Enter Option 1</label>
                            <input type="text" required="required" name="option_1" placeholder="Enter Question" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Enter Option 2</label>
                            <input type="text" required="required" name="option_2" placeholder="Enter Option 2" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Enter Option 3</label>
                            <input type="text" required="required" name="option_3" placeholder="Enter  Option 3" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Enter Option 4</label>
                            <input type="text" required="required" name="option_4" placeholder="Enter  Option 4" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                          <label for="">Image file</label>
                          <input type="file"  name="image_file"  class="form-control">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                          <label for="">Audio file</label>
                          <input type="file"  name="audio_file"  class="form-control">
                      </div>
                    </div>
                    {{-- <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Enter correct ans</label>
                            <input type="text" required="required" name="ans" placeholder="Enter  correct ans" class="form-control">
                        </div>
                    </div> --}}
                    <div class="form-group">
                      <label for="">Select correct option</label>
                      <select class="form-control" required="required" name="ans">
                          <option value="">Select</option>
                        
                          <option value="option_1">option 1</option>
                          <option value="option_2">option 2</option>
                          <option value="option_3">option 3</option>
                          <option value="option_4">option 4</option>
          
                      </select>
                  </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Add</button>
                        </div>
                    </div>
                </div>
            </form>
      </div>
      
    </div>
    </div>	


 
@endsection
