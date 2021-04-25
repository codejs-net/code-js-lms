<?php

namespace App\Imports;

use App\Models\staff;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class StaffImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new staff([
            'id'          => $row['id'],
            'titleid'     => $row['titleid'], 
            'designetion_id'  => $row['designetion_id'], 
            'name_si'     => $row['name_si'], 
            'name_ta'     => $row['name_ta'], 
            'name_en'     => $row['name_en'],
            'address1_si' => $row['address1_si'],
            'address1_ta' => $row['address1_ta'],
            'address1_en' => $row['address1_en'],
            'address2_si' => $row['address2_si'],
            'address2_ta' => $row['address2_ta'],
            'address2_en' => $row['address2_en'],
            'nic'         => $row['nic'],
            'mobile'      => $row['mobile'],
            'birthday'    => $row['birthday'],
            'genderid'    => $row['genderid'],
            'image'       => $row['image'],
        ]);

        }
}
