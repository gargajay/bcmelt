<?php

namespace App\Imports;

use App\Models\Oex_question_master;
use Maatwebsite\Excel\Concerns\ToModel;

class QuestionImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Oex_question_master([
            'questions' => $row[1],
            'eoption1'    => $row[2],
            'eoption2'    => $row[3],
            'eoption3'    => $row[4],
            'eoption4'    => $row[5],
            'ans'    => $row[6],
            'image_file'    => $row[7],
            'audio_file'    => $row[8],
            'category'    => $row[9],
            'status'    => 1,
        ]);
    }
}
