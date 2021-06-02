<?php

namespace App\Imports;

use App\Models\title;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Library_titleImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new title([
            'id'         => $row['id'],
            'title_si'   => $row['si'],
            'title_ta'   => $row['ta'],
            'title_en'   => $row['en'],
        ]);
    }
}
