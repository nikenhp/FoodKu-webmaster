<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    protected $table = 'ordermenu_details';
	public $timestamps = false;

    protected $fillable = [
    	'id_order', 'id_menu', 'kuantitas', 'harga'
    ];
}
