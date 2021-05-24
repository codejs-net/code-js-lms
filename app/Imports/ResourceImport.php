<?php

namespace App\Imports;

use App\Models\resource;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ResourceImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new resource([
            'id'                => $row['id'],
            'accessionNo'       => $row['accession_no'], 
            'standard_number'    => $row['standardnumber'], 
            'title_si'          => ($row['title_si']==null)?'': $row['title_si'], 
            'title_ta'          => ($row['title_ta']==null)?'': $row['title_ta'], 
            'title_en'          => ($row['title_en']==null)?'': $row['title_en'],
            'cretor_id'         => $row['creator_id'],
            'category_id'       => $row['category_id'],
            'type_id'           => $row['type_id'],
            // 'dd_class_id'       => $row['dd_class_id'],
            // 'dd_devision_id'    => $row['dd_devision_id'],
            // 'dd_section_id'     => $row['dd_section_id'],
            // 'ddc'               => $row['ddc'],
            'center_id'         => $row['center_id'],
            'language_id'       => $row['language_id'],
            'publisher_id'      => $row['publisher_id'],
            // 'purchase_date'     => $row['purchase_date'],
            // 'edition'           => $row['edition'],
            'price'             => $row['price'],
            // 'publishyear'       => $row['publishyear'],
            'phydetails'        => $row['phydetails'],
            // 'note_si'           => $row['note_si'],
            // 'note_ta'           => $row['note_ta'],
            // 'note_en'           => $row['note_en'],
            'status'            => $row['status'],
            // 'br_qr_code'        => $row['br_qr_code'],
            'image'             => $row['image']
        ]);

        }
}
