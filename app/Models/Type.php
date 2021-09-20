<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $table = 'types';

    protected $fillable = [
        'id',
        'name',
        'description',
    ];

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_type', 'type_id', 'attribute_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
