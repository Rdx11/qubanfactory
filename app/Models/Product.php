<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

	protected $table = 'product';

    protected $primaryKey = 'id_product';

    public $timestamps = false;

    protected $fillable = [
		'id_product_category', 'name', 'weight', 'price', 'image', 'stock'
    ];

    public function getProductCategory()
    {
        return $this->hasOne('App\Models\ProductCategories', 'id_product_category', 'id_product_category');
    }
}
