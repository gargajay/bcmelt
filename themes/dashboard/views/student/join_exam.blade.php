@extends('layouts.studentexam')
@section('title','Exams')
@section('content')
<style type="text/css">
  /* .question_options>li{
        list-style: none;
        height: 40px;
        line-height: 40px;
    } */


  .donate-now {
    list-style-type: none;
    margin: 25px 0 0 15px;
    padding: 0;
  }

  .donate-now li {
    margin: 0 5px 0 0;
    /*width: 100px;
  height: 40px;*/
    position: relative;
  }

  .donate-now label,
  .donate-now input {
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
  }

  .donate-now input {
    display: block;
    position: absolute;
  }

  .donate-now input[type="radio"] {
    opacity: 0.01;
    z-index: 100;
  }

  .donate-now input[type="radio"]:checked+label,
  .Checked+label {
    background: red;
    pointer-events: none;
  }

  .donate-now label {
    color: #fff;
    padding: 20px 25px;
    border: 1px solid #CCC;
    cursor: pointer;
    z-index: 90;
    background: #0B22A7;
    margin-right: 40px;
  }

  .donate-now label:hover {
    background: #DDD;
  }

  .donate-now p {
    display: inline-block;

  }

  nav span {
    background: #0B22A7 !important;
  }

  .content-header {
    padding: 1px !important;
  }

  .question_options li {
    display: flex;
    align-items: flex-start;
    margin-bottom: 5px;
  }

  /* .question_options li label {
        min-width: 20px;
        margin-right: 5px;
    } */

  .question_options li input[type="radio"] {
    margin-right: 10px;
  }
</style>
<!-- /.content-header -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper2">
  <!-- Content Header (Page header) -->
  <div class="content-header">


    <section class="content" style="background:#26b5e3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card1 ">

              @php
              $key=0;
              @endphp
              <div class="card-body">

                <form action="{{url('student/submit_questions')}}" method="POST" id="frm">
                  <input type="hidden" name="exam_id" value="{{ Request::segment(3)}}">
                  <input type="hidden" name="queans" id="queans" />
                  {{ csrf_field()}}

                  <div class="qw">
                    @include('student.load')
                  </div>




                  <input type="hidden" name="index" value="{{ $key+1}}">

                  <!-- @if($question->lastPage()==$question->currentPage()) -->

                  <!-- @endif -->










              </div>
              </form>

            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="card1">
              <div class="card-body">
                <div style="text-align: center; display: flex; justify-content: space-between; align-items: center;">

                  <div>
                    <button type="button" class="btn" id="myCheck" style="background-color:#0B22A7;color:#fff">Home</button>
                  </div>

                  <div>
                    <p style="color:#fff;">
                      <font>Total Question: <b>{{ $question->total() }}</b></font> &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; <font>Wrong Answer:<b class="corrt">0</b></font>
                    </p>
                  </div>

                  <div>
                    @if(isset($question) && $question->currentPage() > 1)
                    <!-- <a href="{{ $question->previousPageUrl() }}" style="background-color:#0B22A7;color:#fff;" class="btn">Previous</a> -->
                    @endif
                    @if(isset($question) && $question->hasMorePages())
                    <a href="{{ $question->nextPageUrl() }}" style="background-color:#0B22A7;color:#fff;" class="btn ne">Next</a>
                    @endif
                  </div>





                </div>
              </div>
            </div>
          </div>
        </div>


      </div>
    </section>
  </div>
  <!-- /.content-header -->

  <!-- Modal -->



  @endsection
  @section('script')

  <script type="text/javascript">
    $('body').on('click', '.pagination a', function(e) {
      e.preventDefault();

      var url = $(this).attr('href');

      // Create an HTML anchor element
      var link = document.createElement('a');
      link.href = url;

      // Get the query parameter value
      var urlParams = new URLSearchParams(link.search);
      var paramValue = urlParams.get('page');


      var currentPageRadioChecked = $(".input-" + paramValue).is(':checked');
      // alert(paramValue);
      if (currentPageRadioChecked) {
        // Current page radio box is checked
        //alert(1);
        console.log('Current page radio box is checked');
      } else {

        alert('Please choose answer to procced with next question');
        return;
        // Current page radio box is not checked
        //console.log('Current page radio box is not checked');
      }



      window.location.href = url;
    });
  </script>
  <script>
    $(document).ready(function() {
      $(".label-0").text('A');
      $(".label-1").text('B');
      $(".label-2").text('C');
      $(".label-3").text('D');

      var totalCorrect = JSON.parse(localStorage.getItem('tcorrect')) || 0;
      $(".corrt").text(totalCorrect);


      $("#myCheck").click(function(e) {
        //alert(1);
        const qusans = JSON.parse(localStorage.getItem('queans')) || [];
        $("#queans").val(qusans);
        localStorage.setItem("ques", JSON.stringify([]));
        localStorage.setItem("queans", JSON.stringify([]));
        localStorage.setItem("coque", JSON.stringify([]));
        localStorage.setItem("correctans", JSON.stringify([]));
        localStorage.setItem("tcorrect", 0);

        $("#frm").submit();
      });

      const arr2 = JSON.parse(localStorage.getItem('ques')) || [];

      $.each(arr2, function(key, value) {
        if (value !== null) {
          // alert(1);
          var className = $("#" + value).attr('class');
          //alert(className);
          $("#" + value).attr('checked', true);
          $("." + className).prop('disabled', true);


        }
      });

      const arr3 = JSON.parse(localStorage.getItem('correctans')) || [];

      $.each(arr3, function(key, value) {
        if (value !== null) {
          // alert(1);

          var id = $("#" + value).attr("id");


          $(".li-" + id).addClass("bg-success");



        }
      });



      $("input[type='radio']").click(function(event) {
        var radioValue = $(this).val();
        var className = $(this).attr('class');

        var classNames = className.split(' ');
        var firstClassName = classNames[0];

        $("." + firstClassName).prop('disabled', true);


        //   if ($(this).is(':checked')) {
        //   // The input is checked
        //   alert("you have already answered for this question");
        //   event.preventDefault();
        //   return;
        // } 
        var id = $(this).attr("id");
        var qid = $(this).attr("data-q");
        var eid = $(this).attr("data-exam");
        var sid = $(this).attr("data-student");
        var correct = $(this).attr("data-correct");

        var cor = "#li-id-" + qid + "-" + eid + "-" + sid + "-" + correct;
        var cor2 = ".li-id-" + qid + "-" + eid + "-" + sid + "-" + correct;
        //alert(cor);
        if (radioValue) {

          const arr = JSON.parse(localStorage.getItem('ques')) || [];
          arr[qid] = id;
          localStorage.setItem("ques", JSON.stringify(arr))
          const qusans = JSON.parse(localStorage.getItem('queans')) || [];
          qusans[qid] = radioValue;
          localStorage.setItem("queans", JSON.stringify(qusans))
          const correctar = JSON.parse(localStorage.getItem('coque')) || [];
          if (radioValue == correct) {

            const CorrectAns = JSON.parse(localStorage.getItem('correctans')) || [];
            CorrectAns[qid] = id;
            localStorage.setItem("correctans", JSON.stringify(CorrectAns));


            if (correctar[qid] !== 1) {

              // var totalCorrect = JSON.parse(localStorage.getItem('tcorrect')) || 0;

              //     if(totalCorrect!==0)
              //     {
              //       totalCorrect = parseInt(totalCorrect)-1;
              //     }
              //     $(".corrt").text(totalCorrect);
              //     localStorage.setItem('tcorrect',totalCorrect);

            }
          } else {
            // alert(cor2);
            $(cor2).removeClass("bg-danger");
            $(cor2).addClass("bg-success");

            if (correctar[qid] === 1 || correctar[qid] !== "") {
              var totalCorrect = JSON.parse(localStorage.getItem('tcorrect')) || 0;

              totalCorrect = parseInt(totalCorrect) + 1;
              $(".corrt").text(totalCorrect);
              localStorage.setItem('tcorrect', totalCorrect);
            }

          }

          correctar[qid] = 0;
          localStorage.setItem('coque', JSON.stringify(correctar))

          // alert(correct);

          if (radioValue == correct) {
            const correctar = JSON.parse(localStorage.getItem('coque')) || [];
            correctar[qid] = 1;
            localStorage.setItem('coque', JSON.stringify(correctar));
            $(".li-" + id).addClass("bg-success");
          } else {

            // alert(cor2);

            $(".li-" + id).addClass("bg-danger");

            const correctar = JSON.parse(localStorage.getItem('coque')) || [];
          }

        } else {
          // alert('else');
        }
      });
    });
  </script>
  @endsection