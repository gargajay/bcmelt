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
  background: yellow;
}

.donate-now label {
  color: #fff;
  padding: 5px 15px;
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

nav span{
  background: #0B22A7 !important;
}

 
</style>
    <!-- /.content-header -->
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper2" >
    <!-- Content Header (Page header) -->
    <div class="content-header">
      {{-- <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Exams</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Exam</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid --> --}}

      <section class="content" >
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
                
              <!-- Default box -->
              {{-- <div class="card" >
                
                <div class="card-body">
                   <div class="row">
                       <div class="col-sm-4">
                          <h3 class="text-center">Time : {{ $exam->exam_duration}} min</h3>
                       </div>
                       <div class="col-sm-4">
                           <h3><b>Timer</b> :  <span class="js-timeout" id="timer">{{ $exam['exam_duration']}}:00</span></h3>
                       </div>
                       
                        <div class="col-sm-4">
                            <h3 class="text-right"><b>Status</b> :Running</h3>
                        </div>
                   </div>
                </div>
                <!-- /.card-body -->
              </div> --}}
              <!-- /.card -->
              <div class="card1 mt-4"  style="background:#26b5e3"  >
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                  <i class="fas fa-expand-arrows-alt"></i>
                </a>
                @php
                  $key=0;
                @endphp
                <div class="card-body" style="background: #ccffff">

                  <form action="{{url('student/submit_questions')}}" method="POST"  id="frm">
                    <input type="hidden" name="exam_id" value="{{ Request::segment(3)}}">
                    <input type="hidden" name="queans" id="queans" />
                    {{ csrf_field()}}

                    <div class="qw">
                      @include('student.load')
                    </div>

                    
                   

                    <input type="hidden" name="index" value="{{ $key+1}}">

                    @if($question->lastPage()==$question->currentPage())
                    <div class="text-center">
                      <button type="button" class="btn  " id="myCheck" style="margin: auto;background-color:#0B22A7;color:#fff">Submit</button>
                      </div>
                    @endif
                   
                         
                    
                   </div>
                  </form>
                  
                </div>
                <!-- /.card-body -->
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

{{-- <script type="text/javascript">

  $(function() {
      $('body').on('click', '.pagination a', function(e) {
          e.preventDefault();
  
          $('#load a').css('color', '#dfecf6');
          $('#load').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="/images/loading.gif" />');
  
          var url = $(this).attr('href');  
          getArticles(url);
          window.history.pushState("", "", url);
      });
  
      function getArticles(url) {
          $.ajax({
              url : url  
          }).done(function (data) {
              $('.qw').html(data);  
          }).fail(function () {
              alert('Articles could not be loaded.');
          });
      }
  });
  
  </script> --}}
    <script>

      
      $(document).ready(function(){
        var totalCorrect = JSON.parse(localStorage.getItem('tcorrect')) || 0;
        $(".corrt").text(totalCorrect);


        $("#myCheck").click(function(e)
        {
          e.preventDefault();
          const qusans = JSON.parse(localStorage.getItem('queans')) || [];
          $("#queans").val(qusans);
          localStorage.setItem("ques",JSON.stringify([]));
          localStorage.setItem("queans",JSON.stringify([]));
 localStorage.setItem("coque",JSON.stringify([]));

localStorage.setItem("tcorrect",0);



          $("#frm").submit();
          

        });

        const arr2 = JSON.parse(localStorage.getItem('ques')) || [];

        $.each(arr2, function (key, value) 
        {
          if(value!==null){
            $("#"+value).attr('checked', true);

          }
        });  


        $("input[type='radio']").click(function(){
            var radioValue = $(this).val();
            var id = $(this).attr("id");
            var qid = $(this).attr("data-q");
            var eid = $(this).attr("data-exam");
            var sid = $(this).attr("data-student");
            var correct = $(this).attr("data-correct");

            var cor = "#li-id-"+qid+"-"+eid+"-"+sid+"-"+correct;
            var cor2 = ".li-id-"+qid+"-"+eid+"-"+sid+"-"+correct;

            //alert(cor);
            if(radioValue){



              const arr = JSON.parse(localStorage.getItem('ques')) || [];
              

                arr[qid]=id;

                localStorage.setItem("ques",JSON.stringify(arr))


                const qusans = JSON.parse(localStorage.getItem('queans')) || [];

                qusans[qid] = radioValue;

                localStorage.setItem("queans",JSON.stringify(qusans))



                        
                const correctar = JSON.parse(localStorage.getItem('coque')) || [];

                if(radioValue==correct){
                 if(correctar[qid]!==1){
                    var totalCorrect = JSON.parse(localStorage.getItem('tcorrect')) || 0;

                  totalCorrect = parseInt(totalCorrect)+1;

                  $(".corrt").text(totalCorrect);

                  localStorage.setItem('tcorrect',totalCorrect);

                }
                }else{
              //alert(correctar[qid]);
                 if(correctar[qid]===1 || correctar[qid]!==""){
                    var totalCorrect = JSON.parse(localStorage.getItem('tcorrect')) || 0;
		if(totalcorrect!==0)
{
  totalCorrect = parseInt(totalCorrect)-1;

}

                

                  $(".corrt").text(totalCorrect);


                  localStorage.setItem('tcorrect',totalCorrect);

                }
                }

                
                correctar[qid] = 0;
                  localStorage.setItem('coque',JSON.stringify(correctar))

            




              //alert(radioValue);
              
              if(radioValue==correct)
              {




                const correctar = JSON.parse(localStorage.getItem('coque')) || [];


                correctar[qid] = 1;

                 localStorage.setItem('coque',JSON.stringify(correctar))

                
               
                $(".li-"+id).addClass("bg-success");

                
              }else{

                $(".li-"+id).addClass("bg-danger");
                $(cor2).removeClass("bg-danger");
                $(cor2).addClass("bg-success");

                const correctar = JSON.parse(localStorage.getItem('coque')) || [];

               

              }

            }else{

            }
        });
    });
    </script>
@endsection    