<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Oex_student;
use App\Models\Oex_exam_master;
use App\Models\Oex_question_master;
use App\Models\Oex_result;
use App\Models\User;
use App\Models\user_exam;
use Illuminate\Support\Facades\Auth;

class StudentOperation extends Controller
{
    //student dashboard
    public function dashboard(){
        
       $id = Auth::id();

       $ids =  user_exam::where('user_id',$id)->pluck('exam_id')->toArray();

        $data['portal_exams']=user_exam::select(['user_exams.*','users.name','oex_exam_masters.title','oex_exam_masters.category','oex_exam_masters.exam_date'])
        ->join('users','users.id','=','user_exams.user_id')
        ->join('oex_exam_masters','user_exams.exam_id','=','oex_exam_masters.id')->orderBy('user_exams.exam_id','desc')
        ->where('user_exams.user_id',$id)
        ->where('user_exams.std_status','1')
        ->get()->toArray();
        return view('student.dashboard',$data);
    }


    //Exam page
    public function exam(){


             $id = Auth::id();

            $student_info = user_exam::select(['user_exams.*','users.name','oex_exam_masters.title','oex_exam_masters.category','oex_exam_masters.exam_date'])
            ->join('users','users.id','=','user_exams.user_id')
            ->join('oex_exam_masters','user_exams.exam_id','=','oex_exam_masters.id')->orderBy('user_exams.exam_id','desc')
            ->where('user_exams.user_id',$id)
            ->where('user_exams.std_status','1')
            ->get()->toArray();
            
            return view('student.exam',['student_info'=>$student_info]);

    }


    //join exam page
    public function join_exam(Request $request,$id){
        
        // $question= Oex_question_master::inRandomOrder()->paginate(1)->onEachSide(1);

        $exam=Oex_exam_master::where('id',$id)->get()->first();

        $question= Oex_question_master::where('category',$exam->categorys->name)->paginate(1)->onEachSide(1);




      // if ($request->ajax()) {
        //     return view('student.load', ['question' => $question,'exam'=>$exam])->render();  
        // }


        return view('student.join_exam',['question'=>$question,'exam'=>$exam]);
    }



    //On submit
    public function submit_questions(Request $request)
    {

        
        $yes_ans=0;
        $no_ans=0;
        $wrong_ans=0;
        $data= $request->all();

      $questions =  $request->queans;

      //dd($questions);

      $result=array();


      if(!empty($questions))
      {
       $queArr = explode(',',$questions);
       if(!empty($queArr)){
        foreach($queArr as $que => $ans)
        {

            if($que!=0)
            {
                $q=Oex_question_master::where('id',$que)->get()->first();
                if(!empty($ans))
                {
                    if($q->ans==$ans){
                        $result[$que]='YES';
                        $yes_ans++;
                    }elseif($q->ans !=$ans){
                        $result[$que]='wrong';
                        $wrong_ans++;                    
                    }
                }else{
                    $result[$que]='No ans';
                    $no_ans++;  

                }
                
            }
        }
       }
      }
     
    
       $std_info = user_exam::where('user_id',Session::get('id'))->where('exam_id',$request->exam_id)->get()->first();
       $std_info->exam_joined=1;
       $std_info->update();

      $totalQue =  Oex_question_master::count();

     // $no_ans = $totalQue-($yes_ans+$wrong_ans);


       $res = new Oex_result();
       $res->exam_id=$request->exam_id;
       $res->user_id = Session::get('id');
       $res->yes_ans=$yes_ans;
       $res->no_ans=$no_ans;
       $res->wrong_ans=$wrong_ans;
       $res->result_json=json_encode($result);

        $res->save();
       return redirect(url('student/dashboard'));
    }



    //Applying for exam
    public function apply_exam($id){

            $checkuser = user_exam::where('user_id',Session::get('id'))->where('exam_id',$id)->get()->first();

            if($checkuser){
                $arr = array('status'=>'false','message'=>'Already applied, see your exam section');        
            }
            else
            {
                $exam_user = new user_exam();

                $exam_user->user_id= Session::get('id');
                $exam_user->exam_id=$id;
                $exam_user->std_status=1;
                $exam_user->exam_joined=0;
        
                $exam_user->save();
    
                $arr = array('status'=>'true','message'=>'applied successfully','reload'=>url('student/dashboard'));
            }

            echo json_encode($arr);

    }


    //View Result
    public function view_result($id){

            $data['result_info'] = Oex_result::where('exam_id',$id)->where('user_id',Session::get('id'))->latest()->get()->first();
            
            $data['student_info'] = User::where('id',Session::get('id'))->get()->first();

            $data['exam_info']=Oex_exam_master::where('id',$id)->get()->first();

            return view('student.view_result',$data);
    }


    //View answer
    public function view_answer($id){
        
        $data['question']= Oex_question_master::get()->toArray();

        return view('student.view_amswer',$data);
    }

    public function rejoin($id){
        
    $stu_id = Auth::user()->id;

   $exam = user_exam::where('exam_id',$id)->where('user_id',$stu_id)->first();
   $result = Oex_result::where('exam_id',$id)->where('user_id',$stu_id)->first();

   if(!empty($exam))
   {
        $exam->exam_joined=0;
        $exam->save();
   }

   if(!empty($result))
   {
        
        $result->delete();
   }

       return redirect()->back();
    }


    
}
