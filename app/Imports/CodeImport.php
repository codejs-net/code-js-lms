<?php

namespace App\Imports;

use App\Models\code;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CodeImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
  
    public function model(array $row)
    {
        return new code([
            'id'     => $row['id'],
            'code'     => $row['code'],
            'qty'     => $row['qty'],
        ]);
    }
}
