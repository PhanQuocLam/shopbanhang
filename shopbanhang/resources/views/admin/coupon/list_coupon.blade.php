@extends('admin_layout');
@section('admin_content');
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách mã giảm giá
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
     
        
                    
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          
          <span class="input-group-btn">
            
          </span>
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
            
            <th>Tên mã</th>
            <th>Mã giảm giá</th>
            <th>Số lượng giảm giá</th>
            <th>Điều kiện giảm giá</th>
            <th>Số giảm giá</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($coupon as $key => $cou)
          <tr>
            
            <td>{{$cou->coupon_name}}</td>
            <td>{{$cou->coupon_code}}</td>
            <td>{{$cou->coupon_time}}</td>
            <td><span class="text-ellipsis">
              
              <?php
                if($cou->coupon_condition==1){
   
              ?>
              Giảm theo %
              <?php
                }else { 
              ?>
              Giảm theo tiền
              <?php
                }
              ?>
            </span></td>
            <td><span class="text-ellipsis">
              
              <?php
                if($cou->coupon_condition==1){
   
              ?>
              Giảm {{$cou->coupon_number}} %
              <?php
                }else { 
              ?>
              Giảm {{$cou->coupon_number}} VND
              <?php
                }
              ?>
            </span></td>
            
            <td>
              
              <a onclick="return confirm('Are you sure to delete?')" href="{{URL::to('/delete-coupon/'.$cou->coupon_id)}}" class="active" ui-toggle-class="">
              <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach
          
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
         
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
         
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection