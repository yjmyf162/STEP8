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
     * 商品一覧を表示
     * 商品検索
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $Products = Product::all();
        $Companies = Company::all();
        $keyword = $request->input('keyword');
        $choice = $request->input('choice');

        
        //商品検索
        $product = new Product;
        $productSearch = $product->productSearch($request);
        

        return view('home',['Products' => $Products, 'Companies' => $Companies, 'keyword' => $keyword, 'choice' => $choice,]);
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
     * @param int $id
     * @return view
     */
    public function exeDelete($id)
    {
              
        try {
            //商品削除
            Product::destroy($id);
        } catch(\Throwable $e) {
            abort(500);
        }

        return redirect(route('home'));
    }

   
        
}
