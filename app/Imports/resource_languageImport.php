<?php

namespace App\Imports;

use App\Models\resource_language;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class resource_languageImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new resource_language([
            'id'            => $row['id'],
            'language_si'   => $row['si'],
            'language_ta'   => $row['ta'],
            'language_en'   => $row['en'],
        ]);
    }
}
