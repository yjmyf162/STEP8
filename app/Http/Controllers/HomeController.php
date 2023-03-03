<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Product;
use App\Models\Sale;
use App\Http\Requests\ProductRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    

    /**
     * Show the application dashboard.
     * ホームを表示
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $Companies = Company::all();
        return view('home',['Companies' => $Companies]);
        
    }
    
    /**
     * Show the application dashboard.
     * 商品一覧を表示
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showTable(Request $request)
    {        
        $Products = Product::with('Company')->get();

        return $Products;

    }


/**
     * Show the application dashboard.
     * 商品検索
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search(Request $request)
    {
        $product = new Product;
        $productSearch = $product->productSearch($request);

        return ($productSearch);    
    }       
    
    /**
     * Show the application dashboard.
     * 商品一覧をソート
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function sortId(Request $request)
    {        
        $product = new Product;
        $productSortId = $product->productSortId($request);
    
    return ($productSortId);
    }

    public function sortProduct_name(Request $request)
    {        
        $product = new Product;
        $productSortProduct_name = $product->productSortProduct_name($request);

    return ($productSortProduct_name);
    }


    public function sortPrice(Request $request)
    {        
        $product = new Product;
        $productSortPrice = $product->productSortPrice($request);

    return ($productSortPrice);
    }


    public function sortStock(Request $request)
    {        
        $product = new Product;
        $productSortStock = $product->productSortStock($request);

    return ($productSortStock);
    }


    public function sortCompany_name(Request $request)
    {       
        $product = new Product;
        $productSortCompany_name = $product->productSortCompany_name($request);
 
        return ($productSortCompany_name);
    }


   

     /**
     * 商品詳細を表示
     * @param int $id
     * @return view　
     */
    public function showDetail($id)
    {
        $Product = Product::find($id);       

        return view('detail',['Product' => $Product]);
    }

    /**
     * 商品登録画面を表示
     * 
     * @return view
     */
    public function showCreate()
    {
        $Products = Product::all();
        $Companies = Company::all();  
        return view('create',['Products' => $Products, 'Companies' => $Companies]);
    }

    /**
     * 商品情報の登録
     * 
     * @return view
     */
    public function exeRegist(ProductRequest $request)
    {       
        //商品登録
        \DB::beginTransaction();
        try { 
        $product = new Product;
        $productRegist = $product->productRegist($request);
                
        \DB::commit();
        } catch(\Throwable $e) {
        \DB::rollback();    
        abort(500);
        }   

        return redirect(route('create'));
    }




    /**
     * 商品編集画面を表示
     * @param int $id
     * @return view　
     */
    public function showEdit($id)
    {
        $Product = Product::with('company')->find($id);
        $Companies = Company::all();  
        $Products = Product::all();
        
         

        return view('edit',['Product' => $Product, 'Companies' => $Companies, 'Products' => $Products]);
    }


    /**
     * 商品情報の編集
     * 
     * @return view
     */
    public function exeUpdate(ProductRequest $request)
    {
        $inputs = $request->all();
        $Product = Product::with('company')->find($inputs['id'],);
        \DB::beginTransaction();
        try {
        $products = new Product;
        $productEdit = $products->productEdit($request);
    
        \DB::commit();
        } catch(\Throwable $e) {
        \DB::rollback();    
        abort(500);
        }   
         
        return redirect(route('edit', $Product->id ));
    }

    
    /**
     * 商品情報の削除
     * 
     * @return view
     */
    public function exeDelete(Request $request)
    {
            //商品削除
            $product = Product::findOrFail($request->id);
            $product->delete();

            return $product;
    }
        
}
