//一覧表示
$(function(){

  $.ajax({
    type: 'get', //HTTP通信の種類
    url:'/step8/public/home/table', //通信したいURL
    datatype:'json',
  })
  //通信が成功したとき
  .done((res) => { // resの部分にコントローラーから返ってきた値 $Products が入る // <td>{{ $Product->company->company_name }}</td>
    $.each(res, function (index,value) {
      html = `
      
      <tr>                         
              <td>${value.id}</td>
              <td><img src="http://localhost:8888//public/${value.img_path}" width="10%"></td>
              <td>${value.product_name}</td>
              <td>${value.price}</td>
              <td>${value.stock}</td>
              <td>${value.company.company_name}</td>
              <td><input type="submit" value="詳細" class = "btn-detail" onclick = "location.href = '/step8/public/home/${value.id}'"></td>
              <td><form class="id">
              <input data-product_id="${value.id}" type="button" class="btn-delete" value="削除">                      
              </form>
              </td>
                    </tr>
                    
       `;
    $(".product-table").append(html); //できあがったテンプレートを product-tableクラスの中に追加
    });
  //削除機能
  
  $(function (){
   
    $('.btn-delete').on('click', function() {
     let deleteConfirm = confirm('削除してよろしいですか？');
         if(deleteConfirm == true) {
           let clickDelete = $(this);
           let userID = clickDelete.attr('data-product_id');
           
           $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
              
   $.ajax({                   
      type: 'POST',
      url: '/step8/public/home/delete/'+userID, 
      dataType: 'json',
      data: {'id':userID
      }, 
           
               })
               //通信が成功したとき
.done(function(){
clickDelete.parents('tr').remove();      
})
//通信が失敗したとき
.fail(function(){
alert("エラー");
});
 } else {
         (function(e) {
           e.preventDefault();
         });
 };
});
});

})
  //通信が失敗したとき
  .fail((error) => {
    alert("エラー");
  });
});


//検索機能
$(function(){ 

  $('.btn-info').on('click',function(){
      
    $('.product-table').empty(); //もともとある要素を空にする
      
    let keyword = $('#keyword').val();
      let choice = $('#choice').val();
      let price_upper = $('#price_upper').val();
      let price_lower = $('#price_lower').val();
      let stock_upper = $('#stock_upper').val();
      let stock_lower = $('#stock_lower').val();
      
      $.ajax({
        type: 'GET', //HTTP通信の種類
        url:'/step8/public/home/search', //通信したいURL
        data:{
          'keyword':keyword,
          'choice':choice,
          'price_upper':price_upper,
          'price_lower':price_lower,
          'stock_upper':stock_upper,
          'stock_lower':stock_lower,
        },
        dataType: 'json',
      })
      
      //通信が成功したとき
      .done(function(data){
        let html = '';
        $.each(data, function (index, value) { //dataの中身からvalueを取り出す
                          //ここの記述はリファクタ可能
                          let id = value.id;
                          let img_path = value.img_path;
                          let product_name = value.product_name;
                          let price = value.price;
                          let stock = value.stock;
                          let company_name = value.company.company_name;
                          // １ユーザー情報のビューテンプレートを作成
                html = `
                <tr class="product-list">                    
                    <td>${id}</td>
                    <td><img src="http://localhost:8888/step8/public/${img_path}" width="10%"></td>
                    <td>${product_name}</td>
                    <td>${price}</td>
                    <td>${stock}</td>
                    <td>${company_name}</td>
                    <td><input type="submit" value="詳細" class = "btn-detail" onclick = "location.href = '/step8/public/home/${value.id}'"></td>
              <td><form class="id">
              <input data-product_id="${value.id}" type="button" class="btn-delete" value="削除">                      
              </form>
              </td>                     
                </tr>
                    `
                    $('.product-table').append(html);
});

  //削除機能
  
  $(function (){
   
    $('.btn-delete').on('click', function() {
     let deleteConfirm = confirm('削除してよろしいですか？');
         if(deleteConfirm == true) {
           let clickDelete = $(this);
           let userID = clickDelete.attr('data-product_id');
           
           $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
              
   $.ajax({                   
      type: 'POST',
      url: '/step8/public/home/delete/'+userID, 
      dataType: 'json',
      data: {'id':userID
      }, 
           
               })
               //通信が成功したとき
.done(function(){
clickDelete.parents('tr').remove();      
})
//通信が失敗したとき
.fail(function(){
alert("エラー");
});
 } else {
         (function(e) {
           e.preventDefault();
         });
 };
});
});

$(function dele(){});
 //できあがったテンプレートをビューに追加
        })
      //通信が失敗したとき
      .fail(function(){
        alert("検索に失敗しました");
      })
    });
  });

  
//ソート機能(id)
$(function(){ 

  let clickCount = 0;
  let timer = null
  let timeout = 4000;
  let id ="";
  
  $('.sort-id').on('click',function(){

    $(this).data('click', ++clickCount);
    let click = $(this).data('click');
    
       if(click % 2 == 1){
          id = 1;
        }else{
          id = 2;
        }
        if(clickCount == 1){
      timer = setTimeout(function(){       
      timer = null;
      clickCount = 0;
      },timeout)
      
    }  

     
    $('.product-table').empty(); //もともとある要素を空にする     
     
      $.ajax({
        type: 'GET', //HTTP通信の種類
        url:'/step8/public/home/sort/id', //通信したいURL
        data:{
          'id':id,
        },
        dataType: 'json',
      })
      
      //通信が成功したとき
      .done(function(data){
        let html = '';
        $.each(data, function (index, value) { //dataの中身からvalueを取り出す
                          //ここの記述はリファクタ可能
                          let id = value.id;
                          let img_path = value.img_path;
                          let product_name = value.product_name;
                          let price = value.price;
                          let stock = value.stock;
                          let company_name = value.company.company_name;
                          // １ユーザー情報のビューテンプレートを作成
                html = `
                <tr class="product-list">                    
                    <td>${id}</td>
                    <td><img src="http://localhost:8888/step8/public/${img_path}" width="10%"></td>
                    <td>${product_name}</td>
                    <td>${price}</td>
                    <td>${stock}</td>
                    <td>${company_name}</td>
                    <td><input type="submit" value="詳細" class = "btn-detail" onclick = "location.href = '/step8/public/home/${value.id}'"></td>
              <td><form class="id">
              <input data-product_id="${value.id}" type="button" class="btn-delete" value="削除">                      
              </form>
              </td>                     
                </tr>
                    `
                    $('.product-table').append(html);
});

  //削除機能
  
  $(function (){
   
    $('.btn-delete').on('click', function() {
     let deleteConfirm = confirm('削除してよろしいですか？');
         if(deleteConfirm == true) {
           let clickDelete = $(this);
           let userID = clickDelete.attr('data-product_id');
           
           $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
              
   $.ajax({                   
      type: 'POST',
      url: '/step8/public/home/delete/'+userID, 
      dataType: 'json',
      data: {'id':userID
      }, 
           
               })
               //通信が成功したとき
.done(function(){
clickDelete.parents('tr').remove();      
})
//通信が失敗したとき
.fail(function(){
alert("エラー");
});
 } else {
         (function(e) {
           e.preventDefault();
         });
 };
});
});

 //できあがったテンプレートをビューに追加
        })
      //通信が失敗したとき
      .fail(function(){
        alert("失敗しました");
      })
    });
  });
    

  //ソート機能(商品名)
$(function(){ 

  let clickCount = 0;
  let timer = null
  let timeout = 4000;
  let product_name ="";
  $('.sort-product_name').on('click',function(){

    $(this).data('click', ++clickCount);
    let click = $(this).data('click');
    if(click % 2 == 1){
      product_name = 5;
    }else{
      product_name = 6;
    }

    if(clickCount == 1){
      timer = setTimeout(function(){       
      timer = null;
      clickCount = 0;
      },timeout)
      
    }  
      
    $('.product-table').empty(); //もともとある要素を空にする
    
      $.ajax({
        type: 'GET', //HTTP通信の種類
        url:'/step8/public/home/sort/product_name', //通信したいURL
        data:{
          'product_name':product_name,
        },
        dataType: 'json',
      })
      
      //通信が成功したとき
      .done(function(data){
        let html = '';
        $.each(data, function (index, value) { //dataの中身からvalueを取り出す
                          //ここの記述はリファクタ可能
                          let id = value.id;
                          let img_path = value.img_path;
                          let product_name = value.product_name;
                          let price = value.price;
                          let stock = value.stock;
                          let company_name = value.company.company_name;
                          // １ユーザー情報のビューテンプレートを作成
                html = `
                <tr class="product-list">                    
                    <td>${id}</td>
                    <td><img src="http://localhost:8888/step8/public/${img_path}" width="10%"></td>
                    <td>${product_name}</td>
                    <td>${price}</td>
                    <td>${stock}</td>
                    <td>${company_name}</td>
                    <td><input type="submit" value="詳細" class = "btn-detail" onclick = "location.href = '/step8/public/home/${value.id}'"></td>
              <td><form class="id">
              <input data-product_id="${value.id}" type="button" class="btn-delete" value="削除">                      
              </form>
              </td>                     
                </tr>
                    `
                    $('.product-table').append(html);
});

  //削除機能
  
  $(function (){
   
    $('.btn-delete').on('click', function() {
     let deleteConfirm = confirm('削除してよろしいですか？');
         if(deleteConfirm == true) {
           let clickDelete = $(this);
           let userID = clickDelete.attr('data-product_id');
           
           $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
              
   $.ajax({                   
      type: 'POST',
      url: '/step8/public/home/delete/'+userID, 
      dataType: 'json',
      data: {'id':userID
      }, 
           
               })
               //通信が成功したとき
.done(function(){
clickDelete.parents('tr').remove();      
})
//通信が失敗したとき
.fail(function(){
alert("エラー");
});
 } else {
         (function(e) {
           e.preventDefault();
         });
 };
});
});

 //できあがったテンプレートをビューに追加
        })
      //通信が失敗したとき
      .fail(function(){
        alert("失敗しました");
      })
    });
  });
    

  //ソート機能(価格)
  $(function(){ 

    let clickCount = 0;
    let timer = null
    let timeout = 4000;
    let price ="";
    $('.sort-price').on('click',function(){

      $(this).data('click', ++clickCount);
    let click = $(this).data('click');
    if(click % 2 == 1){
      price = 7;
    }else{
      price = 8;
    }

    if(clickCount == 1){
      timer = setTimeout(function(){       
      timer = null;
      clickCount = 0;
      },timeout)
      
    }  
        
      $('.product-table').empty(); //もともとある要素を空にする
      
        $.ajax({
          type: 'GET', //HTTP通信の種類
          url:'/step8/public/home/sort/price', //通信したいURL
          data:{
            'price':price,
          },
          dataType: 'json',
        })
        
        //通信が成功したとき
        .done(function(data){
          let html = '';
          $.each(data, function (index, value) { //dataの中身からvalueを取り出す
                            //ここの記述はリファクタ可能
                            let id = value.id;
                            let img_path = value.img_path;
                            let product_name = value.product_name;
                            let price = value.price;
                            let stock = value.stock;
                            let company_name = value.company.company_name;
                            // １ユーザー情報のビューテンプレートを作成
                  html = `
                  <tr class="product-list">                    
                      <td>${id}</td>
                      <td><img src="http://localhost:8888/step8/public/${img_path}" width="10%"></td>
                      <td>${product_name}</td>
                      <td>${price}</td>
                      <td>${stock}</td>
                      <td>${company_name}</td>
                      <td><input type="submit" value="詳細" class = "btn-detail" onclick = "location.href = '/step8/public/home/${value.id}'"></td>
                <td><form class="id">
                <input data-product_id="${value.id}" type="button" class="btn-delete" value="削除">                      
                </form>
                </td>                     
                  </tr>
                      `
                      $('.product-table').append(html);
  });

    //削除機能
  
    $(function (){
   
      $('.btn-delete').on('click', function() {
       let deleteConfirm = confirm('削除してよろしいですか？');
           if(deleteConfirm == true) {
             let clickDelete = $(this);
             let userID = clickDelete.attr('data-product_id');
             
             $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
                
     $.ajax({                   
        type: 'POST',
        url: '/step8/public/home/delete/'+userID, 
        dataType: 'json',
        data: {'id':userID
        }, 
             
                 })
                 //通信が成功したとき
  .done(function(){
  clickDelete.parents('tr').remove();      
  })
  //通信が失敗したとき
  .fail(function(){
  alert("エラー");
  });
   } else {
           (function(e) {
             e.preventDefault();
           });
   };
  });
  });
  
   //できあがったテンプレートをビューに追加
          })
        //通信が失敗したとき
        .fail(function(){
          alert("失敗しました");
        })
      });
    });
      

//ソート機能(在庫)
$(function(){ 

  let clickCount = 0;
  let timer = null
  let timeout = 4000;
  let stock ="";
  $('.sort-stock').on('click',function(){

    $(this).data('click', ++clickCount);
    let click = $(this).data('click');
    if(click % 2 == 1){
      stock = 9;
    }else{
      stock = 10;
    }

    if(clickCount == 1){
      timer = setTimeout(function(){       
      timer = null;
      clickCount = 0;
      },timeout)
      
    }  
      
    $('.product-table').empty(); //もともとある要素を空にする
    
      $.ajax({
        type: 'GET', //HTTP通信の種類
        url:'/step8/public/home/sort/stock', //通信したいURL
        data:{
          'stock':stock,
        },
        dataType: 'json',
      })
      
      //通信が成功したとき
      .done(function(data){
        let html = '';
        $.each(data, function (index, value) { //dataの中身からvalueを取り出す
                          //ここの記述はリファクタ可能
                          let id = value.id;
                          let img_path = value.img_path;
                          let product_name = value.product_name;
                          let price = value.price;
                          let stock = value.stock;
                          let company_name = value.company.company_name;
                          // １ユーザー情報のビューテンプレートを作成
                html = `
                <tr class="product-list">                    
                    <td>${id}</td>
                    <td><img src="http://localhost:8888/step8/public/${img_path}" width="10%"></td>
                    <td>${product_name}</td>
                    <td>${price}</td>
                    <td>${stock}</td>
                    <td>${company_name}</td>
                    <td><input type="submit" value="詳細" class = "btn-detail" onclick = "location.href = '/step8/public/home/${value.id}'"></td>
              <td><form class="id">
              <input data-product_id="${value.id}" type="button" class="btn-delete" value="削除">                      
              </form>
              </td>                     
                </tr>
                    `
                    $('.product-table').append(html);
});

 //削除機能
  
 $(function (){
   
  $('.btn-delete').on('click', function() {
   let deleteConfirm = confirm('削除してよろしいですか？');
       if(deleteConfirm == true) {
         let clickDelete = $(this);
         let userID = clickDelete.attr('data-product_id');
         
         $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
            
 $.ajax({                   
    type: 'POST',
    url: '/step8/public/home/delete/'+userID, 
    dataType: 'json',
    data: {'id':userID
    }, 
         
             })
             //通信が成功したとき
.done(function(){
clickDelete.parents('tr').remove();      
})
//通信が失敗したとき
.fail(function(){
alert("エラー");
});
} else {
       (function(e) {
         e.preventDefault();
       });
};
});
});

 //できあがったテンプレートをビューに追加
        })
      //通信が失敗したとき
      .fail(function(){
        alert("失敗しました");
      })
    });
  });
    

//ソート機能(メーカー名)
$(function(){ 

  let clickCount = 0;
  let timer = null
  let timeout = 4000;
  let company_name ="";
  $('.sort-company_name').on('click',function(){

    $(this).data('click', ++clickCount);
    let click = $(this).data('click');
    if(click % 2 == 1){
      company_name = 11;
    }else{
      company_name = 12;
    }
    
    if(clickCount == 1){
      timer = setTimeout(function(){       
      timer = null;
      clickCount = 0;
      },timeout)
      
    }  

    $('.product-table').empty(); //もともとある要素を空にする
    
      $.ajax({
        type: 'GET', //HTTP通信の種類
        url:'/step8/public/home/sort/company_name', //通信したいURL
        data:{
          'company_name':company_name
        },
        dataType: 'json',
      })
      
      //通信が成功したとき
      .done(function(data){
        let html = '';
        $.each(data, function (index, value) { //dataの中身からvalueを取り出す
                          //ここの記述はリファクタ可能
                          let id = value.id;
                          let img_path = value.img_path;
                          let product_name = value.product_name;
                          let price = value.price;
                          let stock = value.stock;
                          let company_name = value.company_name;
                          // １ユーザー情報のビューテンプレートを作成
                html = `
                <tr class="product-list">                    
                    <td>${id}</td>
                    <td><img src="http://localhost:8888/step8/public/${img_path}" width="10%"></td>
                    <td>${product_name}</td>
                    <td>${price}</td>
                    <td>${stock}</td>
                    <td>${company_name}</td>
                    <td><input type="submit" value="詳細" class = "btn-detail" onclick = "location.href = '/step8/public/home/${value.id}'"></td>
              <td><form class="id">
              <input data-product_id="${value.id}" type="button" class="btn-delete" value="削除">                      
              </form>
              </td>                     
                </tr>
                    `
                    $('.product-table').append(html);
});

 //削除機能
  
 $(function (){
   
  $('.btn-delete').on('click', function() {
   let deleteConfirm = confirm('削除してよろしいですか？');
       if(deleteConfirm == true) {
         let clickDelete = $(this);
         let userID = clickDelete.attr('data-product_id');
         
         $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
            
 $.ajax({                   
    type: 'POST',
    url: '/step8/public/home/delete/'+userID, 
    dataType: 'json',
    data: {'id':userID
    }, 
         
             })
             //通信が成功したとき
.done(function(){
clickDelete.parents('tr').remove();      
})
//通信が失敗したとき
.fail(function(){
alert("エラー");
});
} else {
       (function(e) {
         e.preventDefault();
       });
};
});
});
 //できあがったテンプレートをビューに追加
        })
      //通信が失敗したとき
      .fail(function(){
        alert("失敗しました");
      })
    });
  });
    



