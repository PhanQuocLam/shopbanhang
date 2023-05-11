@extends('admin_layout');
@section('admin_content');
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách thương hiệu
    </div>
    <div class="row w3-res-tb">
      
      
      <div class="col-sm-3">
        <div class="input-group">
         
        </div>
      </div>
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
            <th>Tên thương hiệu</th>
            <th>Hiển thị</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_brand_product as $key => $brand_pro)
          <tr>
            <td></td>
            <td>{{$brand_pro->brand_name}}</td>
            <td><span class="text-ellipsis">
              
              <?php
                if($brand_pro->brand_status==0){
   
              ?>
              <a href="{{URL::to('/unactive-brand-product/'.$brand_pro->brand_id)}}"> <span class="fa fa-eye"></span></a>
              <?php
                }else { 
              ?>
              <a href="{{URL::to('/active-brand-product/'.$brand_pro->brand_id)}}"> <span class="fa fa-eye-slash"></span></a>
              <?php
                }
              ?>
            </span></td>
            
            <td>
              <a href="{{URL::to('/edit-brand-product/'.$brand_pro->brand_id)}}" class="active" ui-toggle-class="">
              <i class="fa fa-pencil-square-o text-success text-active"></i>
              </a>
              <a onclick="return confirm('Are you sure to delete?')" href="{{URL::to('/delete-brand-product/'.$brand_pro->brand_id)}}" class="active" ui-toggle-class="">
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