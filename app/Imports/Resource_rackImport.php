<?php

namespace App\Imports;

use App\Models\resource_rack;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Resource_rackImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new resource_rack([
            'id'        => $row['id'],
            'rack_si'   => $row['si'],
            'rack_ta'   => $row['ta'],
            'rack_en'   => $row['en'],
        ]);
    }
}
