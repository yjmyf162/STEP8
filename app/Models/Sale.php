<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    //テーブル名
    protected $table = 'sales';

    //可変項目
    protected $fillable =
    [
        'product_id'
    ];
}
