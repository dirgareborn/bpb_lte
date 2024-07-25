<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductsImage extends Model
{
    use HasFactory;


    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
