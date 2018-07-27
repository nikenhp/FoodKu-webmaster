<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'ordermenu';
    public $timestamps = false;

    protected $fillable = [
    	'id_table', 'tanggal', 'pelanggan', 'total', 'bayar', 'kembalian'
    ];
}
