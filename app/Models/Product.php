<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use App\Models\ProductsImage;
use App\Models\ProductAttribute;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'product_facility'  => 'json',
        'product_price'     => 'json',
    ];

    protected static function boot() {
        parent::boot();

        static::creating(function ($product) {
            $product->url = Str::slug($product->product_name, '-');
        });
        static::updating(function ($product) {
            $product->url = Str::slug($product->product_name, '-');
        });
    }

    public function locations(): BelongsTo
    {
        return $this->belongsTo(Location::class,'location_id');
    }

    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class,'category_id')->with('parentcategory');
    }

    public function images(): hasMany
    {
        return $this->hasMany(ProductsImage::class);
    }
    public function attributes(): hasMany
    {
        return $this->hasMany(ProductAttribute::class);
    }
    
}
