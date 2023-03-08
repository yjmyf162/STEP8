@extends('layouts.app')

@section('content')

    <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="http://localhost:8888/step7/public/home/create">新規登録 <span class="sr-only"></span></a>
    <div class="search">    
      <form>
      @foreach($Companies as $Company)
      <input type="hidden" name="id" value="{{ $Company->id }}">
      @endforeach
      <div class="form-group">
        <div>
          <input type="text" id="keyword" placeholder="商品名のキーワードを入力" class="form_control" name="keyword">
            <select id="choice" data-toggle="select" class="form_control" name="choice" >
               <option value="" disabled style='display:none;' @if (empty($Companies->company_name)) selected @endif>メーカーを選択してください</option>
               @foreach($Companies as $Company)
                <option value="{{ $Company->id }}">{{ $Company->company_name }}</option>
               @endforeach
            </select>
            <input type="text" id="price_upper" placeholder="価格の上限値を入力" class="form_control" name="price_upper">
            <input type="text" id="price_lower" placeholder="価格の下限値を入力" class="form_control" name="price_lower">
            <input type="text" id="stock_upper" placeholder="在庫数の上限値を入力" class="form_control" name="stock_upper">
            <input type="text" id="stock_lower" placeholder="在庫数の下限値を入力" class="form_control" name="stock_lower">
          </div>
        <div>
          <input type="button" value="検索" class="btn btn-info"> 
        </div>
      </div>      
      </form>
    </div>
    </div>
  </div>
    </nav>
    </header>
    <br>
    <div class="container">
    <div class="row">
  <div class="col-md-10 col-md-offset-2">
      <h2>商品一覧</h2>
      <table class="table table-striped">
        <form>
          <tr>
              <th><a id="id"  class="sort-id">id</a></th>
              <th>商品画像</th>
              <th><a id="product_name"  class="sort-product_name">商品名</a></th>
              <th><a id="price"  class="sort-price">価格</a></th>
              <th><a id="stock"  class="sort-stock">在庫数</a></th>
              <th><a id="company_name"  class="sort-company_name">メーカー名</a></th>  
              <th>詳細</th>
              <th>削除</th>            
          </tr>
        </form>
         <tbody class="product-table">
         </tbody>
      </table>
    </div>
    </div>
  </div>
@endsection