<div id="load" class="new"  >

   
    @foreach ($question as $key=>$q)


        <div class="row">
            <div class="col-md-12">
                <div class="card-body" style="border-bottom:2px solid #fff">
                    <p>{{ $question->firstItem() + $key }}. {{ $q->questions}}</p>
                </div>
            </div>
        </div>

        <div class="row" >
            <div class="col-sm-7 mt-4">
            
                <?php 


$d= $q->UniqueRandomNumbersWithinRange(1,4,4);



                        $options = $q;
                        $exam_id = $exam->id;
            
                    
                ?>
                <input type="hidden" name="question{{$key+1}}" value="{{$q['id']}}">
                <ul class="question_options donate-now" >

                    @foreach($d as $val)


                    @if($val==1)
                    <li id="li-id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-1"><input type="radio" value="1" name="ans{{$key+1}}" id="id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-1" data-q="{{$q->id}}" data-exam="{{$exam_id}}" data-student="{{ auth()->user()->id }}"   data-correct="{{$q->ans}}">
                        <label for="li-id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-1" class="li-id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-1">A</label>

                        {{ $options['eoption1']}}
                    </li>
                    @elseif($val==2)
                    <li id="li-id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-2"><input type="radio" value="2" name="ans{{$key+1}}" id="id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-2" data-q="{{$q->id}}" data-exam="{{$exam_id}}" data-student="{{ auth()->user()->id }}"   data-correct="{{$q->ans}}"> 
                        <label for="li-id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-2" class="li-id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-2">B</label>
                        {{ $options['eoption2']}}

                    </li>
                    @elseif($val==3)
                    <li id="li-id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-3"><input type="radio" value="3" name="ans{{$key+1}}" id="id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-3" data-q="{{$q->id}}" data-exam="{{$exam_id}}"  data-student="{{ auth()->user()->id }}"  data-correct="{{$q->ans}}"> 
                        <label for="li-id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-3" class="li-id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-3">C</label>
                        {{ $options['eoption3']}}

                    </li>
                    @elseif($val==4)
                    <li id="li-id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-4"><input type="radio" value="4" name="ans{{$key+1}}" id="id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-4" data-q="{{$q->id}}" data-exam="{{$exam_id}}" data-student="{{ auth()->user()->id }}"  data-correct="{{$q->ans}}"> 
                        <label for="li-id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-4" class="li-id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-4" >D</label>
                        {{ $options['eoption4']}}

                    </li>
                    @endif
               
                   
                        
                   
                       
                   
                       
                   

                    @endforeach
                      
                    
                        
                   
               
            
                    <li style="display: none;"><input value="0" type="radio" checked="checked" name="ans{{$key+1}}"> {{ $options['option4']}}</li>
                </ul>

                <div style="margin-top: 40px;margin-left:10% ">
                <p><font>Question id: <b>{{ $question->firstItem() + $key }}</b></font> &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;      <font>Total Question :<b >{{ $question->total() }}</b></font> &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;     <font >Correct Answer:<b class="corrt">0</b></font></p>
                </div>
            </div>
            <div class="col-sm-5 mt-4">
            
                <div >
            
                    @if(!empty($q->image_file))
                    <img src="{{$q->image_file}}" class="img-responsive mb-2" style="max-height:200px">
                    @endif
            
                    <br/>
            
                    @if(!empty($q->audio_file))
                    <audio controls>
                    <source src="{{$q->audio_file}}" type="audio/ogg">
                    <source src="{{$q->audio_file}}" type="audio/mpeg">
                    </audio>
                    @endif
            
                </div>
            
            
            
            </div> 




            
                
            
            
            
        </div>

        
    @endforeach

    
   
    <div class="row mt-10" >
        <div class="col-md-7"></div>
        <div class="col-md-5">
            <div class="pagination ">
                {{-- {{$question->links('pagination::simple')}} --}}

                @if(isset($question))
   @if($question->currentPage() > 1)
      <a href="{{ $question->previousPageUrl() }}" style="margin: auto;background-color:#0B22A7;color:#fff;float:left" class="btn ">Previous</a>
   @endif
 
   @if($question->hasMorePages())
      <a href="{{ $question->nextPageUrl() }}" style="margin: auto;background-color:#0B22A7;color:#fff;float:right" class="btn">Next</a>
   @endif
@endif


        
            </div>
        </div>
    </div>
   



</div>