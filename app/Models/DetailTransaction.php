<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    use HasFactory;

    protected $table = 'detail_transaction';

    protected $primaryKey = 'id';

    protected $fillable = [
		'id_detail_transaction', 'id_transaction', 'id_product', 'quantity', 'item_price', 'total_price', 
    ];

    public function getTransaction()
    {
        return $this->hasOne('App\Models\Transaction', 'id_transaction', 'id_transaction');
    }

    public function getProduct()
    {
        return $this->hasOne('App\Models\Product', 'id_product', 'id_product');
    }
}
