@extends('layouts.studentexam')
@section('title','Portal dashboard')
@section('content')
<?php

use App\Models\Oex_exam_master;

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper2">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">All exams</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"><a href="{{url('student/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item">
              <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a :href="route('logout')" onclick="event.preventDefault();
                                    this.closest('form').submit();">Logout
                </a>
              </form>
            </li>

          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->

      <div class="row">





        @foreach ($portal_exams as $key => $exam)
        <?php
        $cat = Oex_exam_master::getcatgory($exam['category']);
        if (strtotime(date('Y-m-d')) > strtotime($exam['exam_date'])) {
          $cls = "bg-danger";
        } else {
          $val = $key + 1;
          if ($val % 2 == 0)
            $cls = "bg-info";
          else
            $cls = "bg-success";
        }
        ?>
        <div class="col-md-4 col-4">
          <div class="small-box <?php echo $cls; ?>" data-h="{{ url('student/join_exam/'.$exam['exam_id'].'?page=') }}" onclick="handleCardBoxClick(event,{{$key}})">
            <div class="inner">
              <h3>{{ $exam['title']}}</h3>
              <p>{{ $cat }}</p>
              <p>Exam date: {{ $exam['exam_date'] }}</p>
              <?php
              if (strtotime($exam['exam_date']) >= strtotime(date('Y-m-d'))) {
                if ($exam['exam_joined'] == 0) {
              ?>


                  <h5>
                    <input type="text" id="questionNumber{{$key}}" placeholder="Question Number" maxlength="3" oninput="handleInput(event, {{$key}})">
                    <!-- <a style="color:#fff;" href="#" class="btn link btn-sm" data-h="{{ url('student/join_exam/'.$exam['exam_id'].'?page=') }}" onclick="handleClick(event,{{$key}})">Join Exam</a> -->
                  </h5>

              <?php
                }
              }
              ?>

              <p>
                <?php
                if ($exam['exam_joined'] == 1) {
                ?>


              <h5>
                <input type="text" id="questionNumber{{$key}}" placeholder="Question Number" maxlength="3">
                <!-- <a style="color:#fff;" href="#" class="btn link btn-sm" data-h="{{ url('student/join_exam/'.$exam['exam_id'].'?page=') }}" onclick="appendQuestionNumber(this,{{$key}})">Join Exam</a> -->
              </h5><?php
                  }
                    ?>
            </p>

            <p>
              <?php
              if (strtotime($exam['exam_date']) < strtotime(date('Y-m-d'))) {
                echo "Date expired";
              }
              ?>
            </p>
            </div>

            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          </div>
        </div>
        @endforeach

      </div>
      <!-- /.row -->
      <!-- Main row -->

      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->



@endsection
@section('script')
<script>
  function appendQuestionNumber(element, key) {

    var cardBox = event.currentTarget;
    var questionNumber = document.getElementById('questionNumber' + key).value;
    var dataH = cardBox.getAttribute('data-h');
    window.location.href = dataH + questionNumber;
  }

  function handleCardBoxClick(event, key) {
    // Check if the clicked element is an input field
    if (event.target.tagName.toLowerCase() === 'input') {
      // Clicked on the input field, do nothing here
    } else {
      // Clicked anywhere else within the card box, call the function for the small box
      appendQuestionNumber(event, key);
    }
  }

  function handleInput(event, key) {
    // Your input field logic here
    console.log("Typed in the input field with ID: questionNumber" + key);
  }

  
</script>
<script>
  // $(document).ready(function() {
  //   $('.small-box').click(function(e) {
  //     var val = $(this).find('.link').attr('href');
  //     window.location.href = val;
  //     e.preventDefault();



  //   });
  // });
</script>
@endsection