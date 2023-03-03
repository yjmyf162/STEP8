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
      <form method="GET" action="{{ route('search') }}">
      @foreach($Companies as $Company)
      <input type="hidden" name="id" value="{{ $Company->id }}">
      @endforeach
      @csrf 
      <div class="form-group">
        <div>
          <input type="search" placeholder="商品名のキーワードを入力" class="form-control" name="keyword" value="{{ $keyword }}">
        </div>
          <div>
            <select data-toggle="select" class="form-control" name="choice" >
               <option value="" disabled style='display:none;' @if (empty($Companies->company_name)) selected @endif>メーカーを選択してください</option>
               @foreach($Companies as $Company)
                <option value="{{ $Company->id }}">{{ $Company->company_name }}</option>
               @endforeach
            </select>
          </div>
        <div>
          <input type="submit" value="検索" class="btn btn-info"> 
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
          <tr>
              <th>id</th>
              <th>商品画像</th>
              <th>商品名</th>
              <th>価格</th>
              <th>在庫数</th>
              <th>メーカー名</th>  
              <th>詳細</th>
              <th>削除</th>            
          </tr>
          @foreach($Products as $Product)
          <tr>
              <td>{{ $Product->id }}</td>
              <td><img src="{{ asset($Product->img_path) }}" width="10%"></td>
              <td>{{ $Product->product_name }}</td>
              <td>{{ $Product->price }}</td>
              <td>{{ $Product->stock }}</td>
              <td>{{ $Product->company->company_name }}</td>
              <td><button type="button" class = "btn-detail" onclick = "location.href = '/step7/public/home/{{ $Product->id }}'">詳細</button></td>
              <td><form method="POST" enctype="multipart/form-data" action="{{ route('delete', $Product->id) }}" onSubmit="return checkDelete()">
              @csrf                      
              <button type="submit" class = "btn-delete" >削除</button>
              </form>
              </td>
          </tr>
          @endforeach
          
      </table>
    </div>
    </div>
  </div>
<script>
function checkDelete(){
if(window.confirm('削除してよろしいですか？')){
return true;
} else {
return false;
}
}
</script>
@endsection