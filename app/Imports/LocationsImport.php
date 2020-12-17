<?php

namespace App\Imports;

use App\Models\Location;
use Maatwebsite\Excel\Concerns\ToModel;

class LocationsImport implements ToModel
{
    public function model(array $row): Location
    {
        return new Location([
            'postal_code' => $row[1].$row[2],
            'dc' => $row[3],
            'name' => $row[4],
            'codauto' => $row[0]
        ]);
    }
}
