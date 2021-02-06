<?php

namespace App\Imports;

use App\Models\resource_type;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Resource_typeImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new resource_type([
            'id'            => $row['id'],
            'category_id'   => $row['category_id'],
            'type_si'       => $row['si'],
            'type_ta'       => $row['ta'],
            'type_en'       => $row['en'],
            'image'         => $row['image'],
        ]);
    }
}
