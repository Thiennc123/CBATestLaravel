<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection, WithHeadings
{
    public function headings():array
    {
        return[
            'Id',
            'Name',
            'Amount',
            'Price',
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return AppModelsProduct::all();
        return collect(Product::getProduct());
    }
}
