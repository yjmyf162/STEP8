
 @foreach($Products as $Product)
          <tr>
              <td>{{ $Product->id }}</td>
              <td><img src="{{ asset($Product->img_path) }}" width="10%"></td>
              <td>{{ $Product->product_name }}</td>
              <td>{{ $Product->price }}</td>
              <td>{{ $Product->stock }}</td>
              <td>{{ $Product->company->company_name }}</td>
              <td><input type="submit" value="詳細" class = "btn-detail" onclick = "location.href = '/step7/public/home/{{ $Product->id }}'"></td>
              <td><form class="id">
              <input data-product_id="{{ $Product->id }}" type="submit" class="btn-delete" value="削除">                      
              </form>
              </td>
          </tr>
          @endforeach  