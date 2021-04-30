<?php

namespace App\Imports;

use App\Models\resource_floor;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Resource_floorImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new resource_floor([
            // 'id'             => $row['id'],
            'rack_id'        => $row['rack_id'],
            'floor_si'       => $row['si'],
            'floor_ta'       => $row['ta'],
            'floor_en'       => $row['en'],
        ]);
    }
}
