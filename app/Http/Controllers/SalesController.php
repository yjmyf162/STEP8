<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Product;
use App\Models\Sale;
use App\Http\Requests\ProductRequest;

class SalesController extends Controller
{

     /**
     * レコード追加
     */
    public function exeSale(Request $request)
    {        
              
            //商品登録(販売時)
            \DB::beginTransaction();
            try {
            
                $sale = new Sale;
                $saleExeSale = $sale->saleExeSale($request);
                    
            \DB::commit();
            } catch(\Throwable $e) {
            \DB::rollback();    
            abort(500);
            }   
    
            return response()->json($saleExeSale);
        
    }
    
}
