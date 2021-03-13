<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategories extends Model
{
    use HasFactory;

    protected $table = 'product_categories';

    protected $primaryKey = 'id_product_category';

    public $timestamps = false;

    protected $fillable = [
		'id_product_category', 'name', 
    ];

}
