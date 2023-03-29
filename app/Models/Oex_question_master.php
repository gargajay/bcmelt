<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oex_question_master extends Model
{
    use HasFactory;

    protected $table="oex_question_masters";

    protected $primaryKey="id";
    protected $fillable=['questions','ans','eoption1','status','eoption2','eoption3','eoption4','image_file','audio_file','category'];

    public function getImageFileAttribute($value="")
    {
        if($value!='')
        {
            return url('uploads/'.$value);
        }

        return url('uploads/1.png');

    }

    public function getAudioFileAttribute($value="")
    {
        if($value!='')
        {
            return url('uploads/'.$value);
        }

    ///return url('uploads/1.mp3');

    }

   public  function UniqueRandomNumbersWithinRange($min, $max, $quantity) {
        $numbers = range($min, $max);
        shuffle($numbers);
        return array_slice($numbers, 0, $quantity);
    }

   
}
