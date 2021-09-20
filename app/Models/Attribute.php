<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $table = 'attributes';

    protected $fillable = [
        'id',
        'name',
    ];

     public function products()
    {
        return $this->belongsToMany(Product::class, 'attribute_product', 'attribute_id', 'product_id');
    }

    public function types()
    {
        return $this->belongsToMany(Type::class, 'attribute_type', 'attribute_id', 'type_id');
    }
}
