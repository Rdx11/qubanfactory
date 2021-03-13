<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    use HasFactory;

	protected $table = 'pages';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
		'id_pages', 'titles', 'content', 'category'
    ];
}
