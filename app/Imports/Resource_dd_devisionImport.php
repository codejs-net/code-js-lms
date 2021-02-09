<?php

namespace App\Imports;

use App\Models\resource_dd_division;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Resource_dd_devisionImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new resource_dd_division([
            'id'                    => $row['id'],
            'dd_class_id'           => $row['dd_class_id'],
            'devision_code'         => $row['devision_code'],
            'devision_si'           => $row['devision_si'],
            'devision_ta'           => $row['devision_ta'],
            'devision_en'           => $row['devision_en'],
        ]);
    }
}
