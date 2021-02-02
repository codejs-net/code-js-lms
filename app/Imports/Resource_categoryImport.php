<?php

namespace App\Imports;

use App\Models\resource_category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Resource_categoryImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new resource_category([
            'id'            => $row['id'],
            'category_si'   => $row['si'],
            'category_ta'   => $row['ta'],
            'category_en'   => $row['en'],
        ]);
    }
}
