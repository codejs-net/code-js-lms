<?php

namespace App\Imports;

use App\Models\lending_config;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Lending_configImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new lending_config([
            'categoryid'      => $row['id'],
            'lending_limit'   => $row['lending_imit'],
            'lending_period'  => $row['lending_period']
        ]);
    }
}
