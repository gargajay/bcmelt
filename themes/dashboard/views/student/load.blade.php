<div id="load" class="new">
    @foreach ($question as $key=>$q)

    <div style="display: flex; border-bottom: 4px solid #0b22a7;">
        <div style="flex-grow: 1;">
            <p>{{ $question->firstItem() + $key }}. {{ $q->questions}}</p>

        </div>

    </div>
    <div class="row">
        <div class="col-sm-7 mt-4">
            <?php
            $d = $q->UniqueRandomNumbersWithinRange(1, 4, 4);
            $options = $q;
            $exam_id = $exam->id;
            ?>
            <input type="hidden" name="question{{$key+1}}" value="{{$q['id']}}">
            <!-- <ul class="question_options donate-now">

                @foreach($d as $key1 => $val)


                @if($val==1)
                <li id="li-id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-1"><input type="radio" value="1" name="ans{{$key+1}}" id="id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-1" class="c-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}} input-{{ $question->firstItem() + $key+1 }}" data-q="{{$q->id}}" data-exam="{{$exam_id}}" data-student="{{ auth()->user()->id }}" data-correct="{{$q->ans}}">
                    <label for="li-id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-1" class="li-id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-1  label-{{$key1}}">A</label>

                    {{ $options['eoption1']}}
                </li>
                @elseif($val==2)
                <li id="li-id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-2"><input type="radio" value="2" name="ans{{$key+1}}" id="id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-2" class="c-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}} input-{{ $question->firstItem() + $key+1 }}" data-q="{{$q->id}}" data-exam="{{$exam_id}}" data-student="{{ auth()->user()->id }}" data-correct="{{$q->ans}}">
                    <label for="li-id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-2" class="li-id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-2 label-{{$key1}}">B</label>
                    {{ $options['eoption2']}}

                </li>
                @elseif($val==3)
                <li id="li-id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-3"><input type="radio" value="3" name="ans{{$key+1}}" id="id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-3" class="c-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}} input-{{ $question->firstItem() + $key+1 }}" data-q="{{$q->id}}" data-exam="{{$exam_id}}" data-student="{{ auth()->user()->id }}" data-correct="{{$q->ans}}">
                    <label for="li-id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-3" class="li-id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-3 label-{{$key1}}">C</label>
                    {{ $options['eoption3']}}

                </li>
                @elseif($val==4)
                <li id="li-id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-4"><input type="radio" value="4" name="ans{{$key+1}}" id="id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-4" class="c-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}} input-{{ $question->firstItem() + $key+1 }}" data-q="{{$q->id}}" data-exam="{{$exam_id}}" data-student="{{ auth()->user()->id }}" data-correct="{{$q->ans}}">
                    <label for="li-id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-4" class="li-id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-4 label-{{$key1}}">D</label>
                    {{ $options['eoption4']}}

                </li>
                @endif











                @endforeach






                <li style="display: none;"><input value="0" type="radio" checked="checked" name="ans{{$key+1}}"> {{ $options['option4']}}</li>
            </ul> -->

            <ul class="question_options donate-now">
                @foreach($d as $key1 => $val)
                @if($val >= 1 && $val <= 4) <li id="li-id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-{{$val}}">
                    <input type="radio" value="{{$val}}" name="ans{{$key+1}}" id="id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-{{$val}}" class="c-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}} input-{{ $question->firstItem() + $key+1 }}" data-q="{{$q->id}}" data-exam="{{$exam_id}}" data-student="{{ auth()->user()->id }}" data-correct="{{$q->ans}}">
                    <label for="li-id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-{{$val}}" class="li-id-{{$q->id}}-{{$exam_id}}-{{auth()->user()->id}}-{{$val}} label-{{$key1}}">{{ chr(64 + $val) }}</label>
                    {{ $options['eoption'.$val] }}
                    </li>
                    @endif
                    @endforeach
                    <li style="display: none;"><input value="0" type="radio" checked="checked" name="ans{{$key+1}}"> {{ $options['option4']}}</li>
            </ul>


        </div>
        <div class="col-sm-5 mt-4">
            <div>
                <div style="flex-shrink: 0; margin-left: auto;">
                    <b>
                        {{ Auth::User()->name }}
                    </b>
                    <p class="text-danger" style="margin: 0;">(Phone use is not allowed, and photo capturing is banned)</p>
                    <p class="text-danger" style="margin: 0;">(ਫ਼ੋਨ ਦੀ ਵਰਤੋਂ ਦੀ ਇਜਾਜ਼ਤ ਨਹੀਂ ਹੈ, ਅਤੇ ਫੋਟੋ ਕੈਪਚਰ ਕਰਨ 'ਤੇ ਪਾਬੰਦੀ ਹੈ।)</p>

                    </p>
                </div>
                @if(!empty($q->image_file))
                <img src="{{$q->image_file}}" class="img-responsive mb-2" style="max-height:200px; max-width: 100%;
                    ">
                @endif
                <br />
                @if(!empty($q->audio_file))
                <audio controls controlsList="nodownload">
                    <source src="{{$q->audio_file}}" type="audio/ogg">
                    <source src="{{$q->audio_file}}" type="audio/mpeg">
                </audio>
                @endif

            </div>
        </div>

    </div>

    @endforeach

</div>