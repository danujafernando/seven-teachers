<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class StudentImport implements ToCollection
{
    public $rows;
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        //
        $this->rows = $rows;
    }
}
