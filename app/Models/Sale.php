<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Product;
use App\Models\Sale;
use App\Http\Requests\ProductRequest;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

//商品登録(販売時)
public function saleExeSale(Request $request)
    {        
    $inputs = $request->all();
            $Sale = Sale::create($inputs);
            
            $Sale->fill([
                'product_id' => $inputs['product_id'],                        
            ]);
            
            $Product = Product::find($inputs['product_id']);
            $Company = Company::all();
        
        
        $Product->decrement('stock', $inputs['quantity']);
            
        $Sale->save();
        $Product->save();

        return ($Sale);

        }

    //テーブル名
    protected $table = 'sales';

    //可変項目
    protected $fillable =
    [
        'product_id'
    ];
}

