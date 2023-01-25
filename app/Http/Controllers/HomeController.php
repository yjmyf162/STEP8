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
 
        $query = Product::query();

        if(!empty($keyword)) {
            $query->where('product_name', 'LIKE', "%{$keyword}%");        
        }
        
        if(!empty($choice)) {
            $query->where('company_id', 'LIKE', $choice);        
        }


        $Products = $query->get();     

        return view('home',['Products' => $Products, 'Companies' => $Companies, 'keyword' => $keyword, 'choice' => $choice ]);
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
        //商品のデータを受け取る
        $inputs = $request->all();
        $img = $request->file('img_path');
        if(!empty($img)){
        $img_name = $request->file('img_path')->getClientOriginalName();

        // storage > public > img配下に画像が保存される
        $path = $request->file('img_path')->storeAs('public',$img_name); 
        }else{
        $img_name = null;
        }

        \DB::beginTransaction();
        
        //商品登録
        
        $Product = Product::create($inputs);
        $Company = Company::all();
        $Product->fill([
            'product_name' => $inputs['product_name'],
            'company_id' => $inputs['company_name'],            
            'price' => $inputs['price'],
            'stock' => $inputs['stock'],
            'comment' => $inputs['comment'],
            'img_path' => 'storage/' . 'img' . '/' . $img_name,
                        
        ]);
        
        $Product->save();
        
        \DB::commit();
            
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
        //商品のデータを受け取る
        $inputs = $request->all();
        $img = $request->file('img_path');
        if(!empty($img)){
        $img_name = $request->file('img_path')->getClientOriginalName();
        
       
        // storage > public > img配下に画像が保存される
        $path = $request->file('img_path')->storeAs('public/'.'img', $img_name);
        }else{
            $img_name = NULL;
        }
       

        \DB::beginTransaction();
        
        //商品更新
        $Product = Product::with('company')->find($inputs['id'],);
        $Company = Company::find($inputs['id'],);

        $Product->fill([
            'product_name' => $inputs['product_name'],
            'company_id' => $inputs['company_name'],
            'price' => $inputs['price'],
            'stock' => $inputs['stock'],
            'comment' => $inputs['comment'],
            'img_path' => 'storage/' . 'img' . '/' . $img_name,
                        
        ]);
        

        $Product->save();

        \DB::commit();
    

         
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
