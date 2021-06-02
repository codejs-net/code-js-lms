<?php

namespace App\Imports;

use App\Models\survey_suggestion;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class survey_suggestionImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new survey_suggestion([
            'id'              => $row['id'],
            'suggestion_si'   => $row['si'],
            'suggestion_ta'   => $row['ta'],
            'suggestion_en'   => $row['en'],
        ]);
    }
}
