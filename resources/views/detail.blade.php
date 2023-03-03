@extends('layouts.app')

@section('content')

    <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
    <button type="button" onclick="location.href = '/step7/public/home'">戻る</button>
    
    </div>
  </div>
</nav>
    </header>
    <br>
    <div class="container">
    <div class="row">
  <div class="col-md-8 col-md-offset-2">
      <h2>商品詳細</h2>
      <table class="table table-striped">
          <tr>
              <th>商品情報ID</th>
              <th>商品画像</th>
              <th>商品名</th>
              <th>メーカー</th>
              <th>価格</th>
              <th>在庫数</th>  
              <th>コメント</th>
              <th>編集</th>            
          </tr>
          
          <tr>
              <td>{{ $Product->id }}</td>
              <td><img src="{{ asset($Product->img_path) }}" width="10%"></td>
              <td>{{ $Product->product_name }}</td>
              <td>{{ $Product->company->company_name }}</td>
              <td>{{ $Product->price }}</td>
              <td>{{ $Product->stock }}</td>
              <td>{{ $Product->comment }}</td>
              <td><button class = "edit" onclick = "location.href = '{{ $Product->id }}/edit'">編集</button></td>
          </tr>
          
      </table>
  </div>
</div>
    </div>
    <footer class="footer bg-dark  fixed-bottom">
    <div class="container text-center">
    <span class="text-light"></span>
</div>
    </footer>

@endsection