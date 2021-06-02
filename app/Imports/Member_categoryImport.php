<?php

namespace App\Imports;

use App\Models\member_cat;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Member_categoryImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new member_cat([
            'id'            => $row['id'],
            'category_si'   => $row['si'],
            'category_ta'   => $row['ta'],
            'category_en'   => $row['en'],
        ]);
    }
}
