<?php

namespace App\Imports;

use App\Models\resource_dd_class;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Resource_dd_classImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        return new resource_dd_class([
            'id'            => $row['id'],
            'class_code'    => $row['class_code'],
            'class_si'      => $row['class_si'],
            'class_ta'      => $row['class_ta'],
            'class_en'      => $row['class_en'],
        ]);
    }
}
