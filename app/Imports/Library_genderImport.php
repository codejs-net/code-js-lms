<?php

namespace App\Imports;

use App\Models\gender;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Library_genderImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new gender([
            'id'          => $row['id'],
            'gender_si'   => $row['si'],
            'gender_ta'   => $row['ta'],
            'gender_en'   => $row['en'],
        ]);
    }
}
