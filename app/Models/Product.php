<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function company()
    {
        return $this->belongsTo('App\Models\Company','company_id');
    }

    public function sales()
    {
        return $this->hasMany('App\Models\Sale');
    }

    //テーブル名
    protected $table = 'products';

    //可変項目
    protected $fillable =
    [
        'company_id',
        'product_name',
        'price',
        'stock',
        'comment',
        'img_path',
    ];


}
