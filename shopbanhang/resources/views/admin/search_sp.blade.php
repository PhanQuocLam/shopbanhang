@extends('admin_layout');
@section('admin_content');
<div class="table-agile-info">
  <div class="panel panel-default">
    
    <div class="panel-heading">
      Danh sách sản phẩm
    </div>
  
    <?php
    use Illuminate\Support\Facades\Session ;
        $message= Session::get('message');
        if($message){
            echo $message;
             Session::put('message',null);
        }
    ?>
    
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              
            </th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Ảnh</th>
            <th>Danh mục</th>
            <th>Thương hiệu</th>       
            <th>Hiển thị</th>
            
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_product as $key => $pro)
          <tr>
            <td></td>
            <td>{{$pro->product_name}}</td>
            <td>{{$pro->product_quantity}}</td>
            <td>{{$pro->product_price}}</td>
            <td><img src="public/uploads/product/{{$pro->product_image}}" height="100" width="100"></td>
            <td>{{$pro->category_name}}</td>
            <td>{{$pro->brand_name}}</td>
            
            <td><span class="text-ellipsis">
              
              <?php
                if($pro->product_status==0){
   
              ?>
              <a href="{{URL::to('/unactive-product/'.$pro->product_id)}}"> <span class="fa fa-eye"></span></a>
              <?php
                }else { 
              ?>
              <a href="{{URL::to('/active-product/'.$pro->product_id)}}"> <span class="fa fa-eye-slash"></span></a>
              <?php
                }
              ?>
            </span></td>
            
            <td>
              <a href="{{URL::to('/edit-product/'.$pro->product_id)}}" class="active" ui-toggle-class="">
              <i class="fa fa-pencil-square-o text-success text-active"></i>
              </a>
              <a onclick="return confirm('Are you sure to delete?')" href="{{URL::to('/delete-product/'.$pro->product_id)}}" class="active" ui-toggle-class="">
              <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>
          
          @endforeach
          
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row" align="center">
        <nav>
      {!! $all_product->links() !!}
        </nav>
      </div>
    </footer>
  </div>
</div>
@endsection