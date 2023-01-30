<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Product;
use App\Models\Sale;
use App\Http\Requests\ProductRequest;
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

    public function productSearch(Request $request){
        

        
 
        $query = Product::query();

        if(!empty($keyword)) {
            $query->where('product_name', 'LIKE', "%{$keyword}%");        
        }
        
        if(!empty($choice)) {
            $query->where('company_id', 'LIKE', $choice);        
        }


        $Products = $query->get();
             

    }

    public function productRegist(ProductRequest $request){

        //商品のデータを受け取る
        $inputs = $request->all();
        $img = $request->file('img_path');
        if(!empty($img)){
        $img_name = $request->file('img_path')->getClientOriginalName();
        $img_path = 'storage/' . 'img' . '/' . $img_name;
        // storage > public > img配下に画像が保存される
        $path = $request->file('img_path')->storeAs('public/'.'img', $img_name); 
        }else{
        $img_name = null;
        $img_path = null;
        }  

    
        //商品登録        
        $Product = Product::create($inputs);
        $Company = Company::all();
        
        $Product->fill([
            'product_name' => $inputs['product_name'],
            'company_id' => $inputs['company_name'],            
            'price' => $inputs['price'],
            'stock' => $inputs['stock'],
            'comment' => $inputs['comment'],
            'img_path' => $img_path,
                        
        ]);
        $Product->save();
    }

    public function productEdit(ProductRequest $request){

        //商品のデータを受け取る
        $inputs = $request->all();
        $img = $request->file('img_path');
        if(!empty($img)){
        $img_name = $request->file('img_path')->getClientOriginalName();
        $img_path = 'storage/' . 'img' . '/' . $img_name;       
        // storage > public > img配下に画像が保存される
        $path = $request->file('img_path')->storeAs('public/'.'img', $img_name);
        }else{
            $img_name = null;
            $img_path = null;
        }
       
                        
        //商品更新
        $Product = Product::with('company')->find($inputs['id'],);
        $Company = Company::find($inputs['id'],);

        $Product->fill([
            'product_name' => $inputs['product_name'],
            'company_id' => $inputs['company_name'],
            'price' => $inputs['price'],
            'stock' => $inputs['stock'],
            'comment' => $inputs['comment'],
            'img_path' => $img_path,
                        
        ]);       

        $Product->save();
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
