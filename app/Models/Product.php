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
        
        //データ取得
        $inputs = $request->all();
        $keyword = $inputs['keyword'];
        $choice = $inputs['choice'];
        $price_upper = $inputs['price_upper'];
        $price_lower = $inputs['price_lower'];
        $stock_upper = $inputs['stock_upper'];
        $stock_lower = $inputs['stock_lower'];

        //商品検索
        
        
        if(!empty($keyword || $choice)){
            $products = Product::with('Company')->where('product_name', 'LIKE', "%{$keyword}%")
                    ->where('company_id', 'LIKE', $choice)->get();}

                    if((!empty($stock_upper && $stock_lower))&&(!empty($price_upper && $price_lower))){
                        $products = Product::with('Company')->where('product_name', 'LIKE', "%{$keyword}%")
                        ->where('company_id', 'LIKE', $choice)->where('price', '<=', $price_upper)
                        ->where('price', '>=', $price_lower)->where('stock', '<=', $stock_upper)
                        ->where('stock', '>=', $stock_lower)->get();}

                        elseif((!empty($stock_upper && $stock_lower))&&(!empty($price_upper))){
                        $products = Product::with('Company')->where('product_name', 'LIKE', "%{$keyword}%")
                        ->where('company_id', 'LIKE', $choice)->where('price', '<=', $price_upper)
                        ->where('stock', '<=', $stock_upper)
                        ->where('stock', '>=', $stock_lower)->get();}

                        elseif((!empty($stock_upper && $stock_lower))&&(!empty($price_lower))){
                            $products = Product::with('Company')->where('product_name', 'LIKE', "%{$keyword}%")
                            ->where('company_id', 'LIKE', $choice)
                            ->where('price', '>=', $price_lower)->where('stock', '<=', $stock_upper)
                            ->where('stock', '>=', $stock_lower)->get();}
                    
                            elseif((!empty($stock_upper))&&(!empty($price_upper && $price_lower))){
                                $products = Product::with('Company')->where('product_name', 'LIKE', "%{$keyword}%")
                                ->where('company_id', 'LIKE', $choice)->where('price', '<=', $price_upper)
                                ->where('price', '>=', $price_lower)->where('stock', '<=', $stock_upper)
                                ->get();}

                                elseif((!empty($stock_lower))&&(!empty($price_upper && $price_lower))){
                                    $products = Product::with('Company')->where('product_name', 'LIKE', "%{$keyword}%")
                                    ->where('company_id', 'LIKE', $choice)->where('price', '<=', $price_upper)
                                    ->where('price', '>=', $price_lower)
                                    ->where('stock', '>=', $stock_lower)->get();}
                    
                        elseif(!empty($stock_upper && $stock_lower)){
                            $products = Product::with('Company')->where('product_name', 'LIKE', "%{$keyword}%")
                            ->where('company_id', 'LIKE', $choice)->where('stock', '<=', $stock_upper)
                            ->where('stock', '>=', $stock_lower)->get();}

                            elseif(!empty($stock_upper && $price_upper)){
                                $products = Product::with('Company')->where('product_name', 'LIKE', "%{$keyword}%")
                                ->where('company_id', 'LIKE', $choice)->where('stock', '<=', $stock_upper)
                                ->where('price', '<=', $price_upper)->get();}

                                elseif(!empty($stock_upper && $price_lower)){
                                    $products = Product::with('Company')->where('product_name', 'LIKE', "%{$keyword}%")
                                    ->where('company_id', 'LIKE', $choice)->where('stock', '<=', $stock_upper)
                                    ->where('price', '>=', $price_lower)->get();}
    

                            elseif(!empty($price_upper && $price_lower)){
                                $products = Product::with('Company')->where('product_name', 'LIKE', "%{$keyword}%")
                                ->where('company_id', 'LIKE', $choice)->where('price', '<=', $price_upper)
                                ->where('price', '>=', $price_lower)->get();}

                            elseif(!empty($price_upper && $stock_lower)){
                                $products = Product::with('Company')->where('product_name', 'LIKE', "%{$keyword}%")
                                ->where('company_id', 'LIKE', $choice)->where('price', '<=', $price_upper)
                                ->where('stock', '>=', $stock_lower)->get();}

                                elseif(!empty($stock_lower && $price_lower)){
                                    $products = Product::with('Company')->where('product_name', 'LIKE', "%{$keyword}%")
                                    ->where('company_id', 'LIKE', $choice)->where('stock', '>=', $stock_lower)
                                    ->where('price', '>=', $price_lower)->get();}

                                    elseif(!empty($stock_upper)){
                                        $products = Product::with('Company')->where('product_name', 'LIKE', "%{$keyword}%")
                                        ->where('company_id', 'LIKE', $choice)->where('stock', '<=', $stock_upper)
                                        ->get();}
                                    
                                        elseif(!empty($stock_lower)){
                                            $products = Product::with('Company')->where('product_name', 'LIKE', "%{$keyword}%")
                                            ->where('company_id', 'LIKE', $choice)
                                            ->where('stock', '>=', $stock_lower)->get();}

                                            elseif(!empty($price_upper)){
                                                $products = Product::with('Company')->where('product_name', 'LIKE', "%{$keyword}%")
                                                ->where('company_id', 'LIKE', $choice)->where('price', '<=', $price_upper)
                                                ->get();}

                                                elseif(!empty($price_lower)){
                                                    $products = Product::with('Company')->where('product_name', 'LIKE', "%{$keyword}%")
                                                    ->where('company_id', 'LIKE', $choice)
                                                    ->where('price', '>=', $price_lower)->get();}
                        
                            return ($products);    
    }       
        
 
    public function productSortId(Request $request)
    {        
        $sort = $request->all();
        
        $id = $sort['id'];
        

        if(!empty($id)){
        if ($id){
            if($id == '1'){
                $products = Product::with('Company')->orderBy('id')->get();
            }elseif($sort['id'] == '2'){
                $products = Product::with('Company')->orderBy('id','DESC')->get();
            }
        }
    }
    
    return ($products);
    }
             

    public function productSortProduct_name(Request $request)
    {        
        $sort = $request->all();
        
        $product_name = $sort['product_name'];
        
        if(!empty($product_name)){
        if ($product_name){
            if($product_name == '5'){
                $products = Product::with('Company')->orderBy('product_name')->get();
            }elseif($sort['product_name'] == '6'){
                $products = Product::with('Company')->orderBy('product_name','DESC')->get();
            }
        }
    }

    return ($products);
    }

    public function productSortPrice(Request $request)
    {        
        $sort = $request->all();
           
        $price = $sort['price'];


    if(!empty($price)){
        if ($price){
            if($price == '7'){
                $products = Product::with('Company')->orderBy('price')->get();
            }elseif($sort['price'] == '8'){
                $products = Product::with('Company')->orderBy('price','DESC')->get();
            }
        }
    }

    return ($products);
    }


    public function productSortStock(Request $request)
    {        
        $sort = $request->all();
    
        $stock = $sort['stock'];
        

    if(!empty($stock)){
        if ($stock){
            if($stock == '9'){
                $products = Product::with('Company')->orderBy('stock')->get();
            }elseif($sort['stock'] == '10'){
                $products = Product::with('Company')->orderBy('stock','DESC')->get();
            }
        }
    }

    return ($products);
    }


    public function productSortCompany_name(Request $request)
    {        
        $sort = $request->all();
        
        $company_name = $sort['company_name'];

    if(!empty($company_name)){
        if ($company_name){
            if($company_name == '11'){
                $products = Product::select('products.id','companies.id as company_id','products.product_name','products.price','products.stock','products.img_path','companies.company_name')
        ->join('companies','products.company_id','=','companies.id')->orderBy('company_name')
        ->get();
            }elseif($company_name == '12'){
                $products = Product::select('products.id','companies.id as company_id','products.product_name','products.price','products.stock','products.img_path','companies.company_name')
        ->join('companies','products.company_id','=','companies.id')->orderBy('company_name','DESC')
        ->get();
            }
        }
    }

        return ($products);
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
