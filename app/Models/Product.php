<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'email',
        'amount',
        'price',  
        'supplier',
        'type_id',
    ];

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_product', 'product_id', 'attribute_id')->withPivot('value');;
    }

    public function medias()
    {
        return $this->hasMany(Media::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public static function getProduct()
    {
        $records = DB::table('products')->select('id', 'name', 'amount', 'price')->get()->toArray();
        return $records;
    }
}
