@extends('admin_layout');
@section('admin_content');
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh mục sản phẩm
    </div>
    <div class="row w3-res-tb">
      
      
      
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
              <label class="i-checks m-b-none">
                
              </label>
            </th>
            <th>Tên danh mục</th>
            <th>Hiển thị</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_category_product as $key => $cate_pro)
          <tr>
            <td></td>
            <td>{{$cate_pro->category_name}}</td>
            <td><span class="text-ellipsis">
              
              <?php
                if($cate_pro->category_status==0){
   
              ?>
              <a href="{{URL::to('/unactive-category-product/'.$cate_pro->category_id)}}"> <span class="fa fa-eye"></span></a>
              <?php
                }else { 
              ?>
              <a href="{{URL::to('/active-category-product/'.$cate_pro->category_id)}}"> <span class="fa fa-eye-slash"></span></a>
              <?php
                }
              ?>
            </span></td>
            
            <td>
              <a href="{{URL::to('/edit-category-product/'.$cate_pro->category_id)}}" class="active" ui-toggle-class="">
              <i class="fa fa-pencil-square-o text-success text-active"></i>
              </a>
              <a onclick="return confirm('Are you sure to delete?')" href="{{URL::to('/delete-category-product/'.$cate_pro->category_id)}}" class="active" ui-toggle-class="">
              <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach
          
        </tbody>
      </table>
    </div>
    
  </div>
</div>
@endsection