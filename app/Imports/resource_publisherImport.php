<?php

namespace App\Imports;

use App\Models\resource_publisher;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class resource_publisherImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new resource_publisher([
            'id'            => $row['id'],
            'publisher_si'   => $row['si'],
            'publisher_ta'   => $row['ta'],
            'publisher_en'   => $row['en'],
        ]);
    }
}
