<?php

namespace App\Imports;

use App\Models\Commune;
use Maatwebsite\Excel\Concerns\ToModel;

class CommuneImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Commune([
            'name' => $row[1],
            'district_id' => $row[4]
        ]);
    }
}
