<?php

namespace App\Imports;

use App\Models\designetion;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Staff_designationImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new designetion([
            'id'               => $row['id'],
            'designetion_si'   => $row['si'],
            'designetion_ta'   => $row['ta'],
            'designetion_en'   => $row['en'],
        ]);
    }
}
