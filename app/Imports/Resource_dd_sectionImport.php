<?php

namespace App\Imports;

use App\Models\resource_dd_section;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Resource_dd_sectionImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new resource_dd_section([
            'id'                   => $row['id'],
            'dd_class_id'          => $row['class_id'],
            'dd_devision_id'       => $row['devision_id'],
            'section_code'         => $row['section_code'],
            'section_si'           => $row['section_si'],
            'section_ta'           => $row['section_ta'],
            'section_en'           => $row['section_en'],
        ]);
    }
}
