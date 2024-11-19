<?php

namespace App\Imports;

use App\Models\Contractor;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithSkipDuplicates;

class ContractorsImportTools implements ToModel, WithSkipDuplicates
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Contractor([
            'name' => $row[0],
        ]);
    }
}
