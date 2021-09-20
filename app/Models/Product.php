<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'email',
        'password',
        'amount',
        'price',  
        'supplier',
    ];

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_product', 'product_id', 'attribute_id');
    }

    public function medias()
    {
        return $this->hasMany(Media::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
