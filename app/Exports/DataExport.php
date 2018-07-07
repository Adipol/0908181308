<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Product;

class DataExport implements FromCollection
{
    public function collection()
    {
        return Product::all();
    }
}