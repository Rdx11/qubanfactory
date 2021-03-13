<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryInfo extends Model
{
    use HasFactory;

    protected $table = 'pages';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
		'id_delivery_info', 'id_transaction', 'sender_phone', 'consignee_phone', 'delivery_date', 'arrival_estimation', 'status'
    ];

    public function getProvine()
    {
        return $this->hasOne('App\Models\ProductCategory', 'id_transaction', 'id_transaction');
    }
}
