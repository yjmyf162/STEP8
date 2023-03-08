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
            $product_id = $inputs['product_id'];
            $quantity = $inputs['quantity'];
            $Product = Product::find($product_id);
            $productStock = Product::where('id','=',$product_id)->value('stock');

            $Sale->fill([
                'product_id' => $product_id ,                        
            ]);           
        
        if($productStock >= $quantity)
        {
            
        $Product->decrement('stock', $quantity);

        $Sale->save();
        $Product->save();
        }else{
            abort(500);
        }
        return array($Sale,$Product);

    }

    //テーブル名
    protected $table = 'sales';

    //可変項目
    protected $fillable =
    [
        'product_id'
    ];
}

