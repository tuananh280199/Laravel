<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'products';
    protected $guarded = [];
    public function images() //one to many (1 sản phẩm có nhiều ảnh)
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
    public function tags() //many to many ()
    {
        return $this
            ->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id')
            ->withTimestamps();
    }
    public function category() //one to many (1 ảnh nhiều sp)
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
