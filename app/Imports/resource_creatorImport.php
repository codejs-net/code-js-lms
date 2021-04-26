<?php

namespace App\Imports;

use App\Models\resource_creator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class resource_creatorImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new resource_creator([
            'id'            => $row['id'],
            // 'titleid'         => $row['titleid'],
            'name_si'       => $row['name_si'],
            'name_ta'       => $row['name_ta'],
            'name_en'       => $row['name_en'],
            'address1_si'   => $row['address1_si'],
            'address1_ta'   => $row['address1_ta'],
            'address1_en'   => $row['address1_en'],
            'address2_si'   => $row['address2_si'],
            'address2_ta'   => $row['address2_ta'],
            'address2_en'   => $row['address2_en'],
            'mobile'        => $row['mobile'],
            // 'genderid'        => $row['genderid'],
            'description'   => $row['description'],
            'image'         => $row['image'],

        ]);
    }
}
