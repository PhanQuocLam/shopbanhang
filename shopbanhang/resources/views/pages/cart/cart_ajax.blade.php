@extends('welcome')
@section('content')
<?php use Illuminate\Support\Facades\Session ;
use App\Models\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;
?>
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Giỏ hàng của bạn</li>
				</ol>
			</div>
			<?php
                            $message= Session::get('message');
                            if($message){
                            echo $message;
                            Session::put('message',null);
                             }
                        ?>
			<div class="table-responsive cart_info">
				<form action="{{url('update-cart')}}" method="POST">
				{{csrf_field()}}
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh</td>
							<td class="description">Tên sản phẩm</td>
							<td class="price">Giá</td>
							<td class="quantity">Số Lượng</td>
							<td class="total">Thành tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@if(Session::get('cart')==true)
						<?php
							$total=0;
						
						?>
                        @foreach(Session::get('cart') as $key => $cart)
						
						<?php
							$subtotal=$cart['product_price']*$cart['product_qty'];
							$total+=$subtotal;

						?>
						<tr>
							<td class="cart_product">
								<img src="{{asset('public/uploads/product/'.$cart['product_image'])}}" width="90" alt="">
							</td>
							<td class="cart_description">
								<h4><a href=""></a></h4>
								<p>{{$cart['product_name']}}</p>
							</td>
							<td class="cart_price">
								<p>{{number_format($cart['product_price'],0,',','.')}}VNĐ</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
                                    
									<input class="cart_quantity" type="number" min="1" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}" >
									
                                    
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">{{number_format($subtotal,0,',','.')}}VNĐ</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{url('/del-product/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
						<tr><td><input type="submit" value="cập nhật giỏ hàng" name="update_qty" class="check_out btn btn-default btn-sm"></td>
						<td><a class="btn btn-default check_out" href="{{url('/del-all-product')}}">Xóa tất cả sản phẩm</a></td>
						<td>
							@if(Session::get('coupon'))
							<a class="btn btn-default check_out" href="{{url('/unset-coupon')}}">Xóa mã khuyến mãi</a>
							@endif</td>
						
						<td>
							<?php
									
									$customer_id=Session::get('customer_id');
		
									$shipping_id= Session::get('shipping_id');
									if($customer_id!=NULL&&$shipping_id==NULL){
								?>
								<li><a class="btn btn-default check_out"  href="{{URL::to('/checkout')}}"></i>Thanh toán</a></li>
								
								<?php
							}elseif($customer_id!=NULL&&$shipping_id!=NULL){
								?>
								<li><a class="btn btn-default check_out" href="{{URL::to('/payment')}}"></i>Thanh toán</a></li>
								<?php
							}else{
								?>
								<li><a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}"></i>Thanh toán</a></li>
								
								
								<?php
							}
							?>
							
						</td>
						<td colspan="2">
							<li>Tổng:<span>{{number_format($total,0,',','.')}}VNĐ</span></li>
							<li>Thuế VAT:<span>8%</span></li>
							<li>Tổng sau thuế:{{number_format($total+$total*0.08,0,',','.')}}VNĐ</li>
							@if(Session::get('coupon'))
							<li>
								
								@foreach(Session::get('coupon') as $key => $cou)
										@if($cou['coupon_condition']==1)
										Mã giảm: {{$cou['coupon_number']}}%
							 			<p>
											<?php
											 $total_coupon=($total*$cou['coupon_number'])/100;
											 echo'<p>Tổng tiền giảm:'.number_format($total_coupon,0,',','.').'VNĐ</p>';
							 				?>
										</p>
										<p><li>Tổng đã giảm:{{number_format($total+$total*0.08-$total_coupon,0,',','.')}}VNĐ</li></p>
										@elseif($cou['coupon_condition']==2)
										Mã giảm: {{number_format($cou['coupon_number'],0,',','.')}}VNĐ
							 			<p>
											<?php
											 $total_coupon=$total-$cou['coupon_number'];
							 				?>
										</p>
										<p><li>Tổng đã giảm:{{number_format($total_coupon,0,',','.')}}VNĐ</li></p>	 
										@endif
								@endforeach
								
								
								@endif

								
							</li>
							<!-- <li>Thuế <span></span></li>
							<li>Phí vận chuyển<span>Free</span></li> -->
							
						</td>
						<td>
							
							
						</td>
						</tr>
						@else
						<tr>
							<td colspan="5">
							<?php
							echo 'Làm ơn thêm sản phẩm vô giỏ';
							
							?>
							</td>
						</tr>
						@endif
					</tbody>
			</form>
							 @if(Session::get('cart'))
						<tr>
							<td><form method="POST" action="{{url('/check-coupon')}}">
							{{csrf_field()}}
							<input type="text" class="form--control" id="coupon" name="coupon" placeholder="Nhập mã giảm giá"><br>
							<input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Tính mã giảm giá">
							</form>
							
							
						</td>
						</tr>
							 @endif
				</table>
			</div>
		</div>
	</section> 
@endsection