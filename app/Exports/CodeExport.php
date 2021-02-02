<?php

namespace App\Exports;

use App\Models\code;
use Maatwebsite\Excel\Concerns\FromCollection;

class CodeExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return code::all();
    }
}
