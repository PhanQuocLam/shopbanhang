@extends('admin_layout');
@section('admin_content');
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê đơn hàng
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
            
            <th>Thứ tự</th>
            <th>Mã đơn hàng</th>
            <th>Ngày tháng đặt hàng</th>
            <th>Tình trạng đơn hàng</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i=0;
          ?>
          @foreach($order as $key => $ord)
            <?php
            $i++;
            ?>
          <tr>
            <td><i>{{$i}}</i></td>
            <td>{{$ord->order_code}}</td>
            <td>{{$ord->created_at}}</td>
            <td>@if($ord->order_status==1)
                  Đơn hàng mới
                @elseif($ord->order_status==2)
                  Đơn hàng đã xử lý
                @else
                  Đơn hàng đã hủy
                @endif


            </td>
            
            
            <td>
              <a href="{{URL::to('/view-order/'.$ord->order_code)}}" class="active" ui-toggle-class="">
              <i class="fa fa-eye text-success text-active"></i>
              </a>
              <a onclick="return confirm('Bạn có muốn xóa đơn hàng không?')" href="{{URL::to('/delete-order/'.$ord->order_id)}}" class="active" ui-toggle-class="">
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