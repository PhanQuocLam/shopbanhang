@extends('welcome')
@section('content')
<?php use Illuminate\Support\Facades\Session ;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

?>
<section id="cart_items">
		<div class="container">
		
		<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Thanh toán giỏ hàng</li>
				</ol>
			</div>

			
			

			<div class="register-req">
			<?php
									
									$customer_id=Session::get('customer_id');
									if($customer_id!=NULL){
								?>
								
								
								<?php
							}else{
								?>
								<p>Làm ơn đăng ký hoặc đăng nhập để thanh toán giỏ hàng và xem lại lịch sử mua hàng</p>
								<?php
							}
								?>
				
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<p>Điền thông tin gửi hàng</p>
							<div class="form-one">
							<form>
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label>Chọn thành phố</label>
                                    <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                                        <option value="">----Chọn thành phố----</option>
                                        @foreach($city as $key =>$ci)
                                        <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Chọn quận huyện</label>
                                    <select name="province" id="province" class="form-control input-sm m-bot15 choose province ">
                                        <option value="">----Chọn quận huyện----</option>
                                       
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Chọn xã phường</label>
                                    <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                    <option value="">----Chọn xã phường----</option>
                                        

                                    </select>
                                </div>
                                
                                <input type="button" value="Tính phí vận chuyển" name="calculate_order" class="btn btn-primary btn-sm calculate_delivery">

                            </form>
								<form  action="{{URL::to('/login-customer')}}" method="POST">
									{{csrf_field()}}
									<input type="text" name="shipping_email" class="shipping_email" placeholder="Email*">
									<input type="text" name="shipping_name" class="shipping_name" placeholder="Họ và tên">
									<input type="text" name="shipping_address" class="shipping_address" placeholder="Địa chỉ *">
									<input type="text" name="shipping_phone" class="shipping_phone" placeholder="Điện thoại">
									<textarea  name="shipping_notes" class="shipping_notes"  placeholder="Ghi chú đơn hàng" rows="5"></textarea>
									
									
									@if(Session::get('fee'))
									<input type="hidden" name="order_fee" class="order_fee" placeholder="" value="{{Session::get('fee')}}">
									@else
									<input type="hidden" name="order_fee" class="order_fee" placeholder="" value="15000">
									@endif

									@if(Session::get('coupon'))
										@foreach(Session::get('coupon') as $key=>$cou )
									<input type="hidden" name="order_coupon" class="order_coupon" placeholder="" value="{{$cou['coupon_code']}}">
										@endforeach
									@else
									<input type="hidden" name="order_coupon" class="order_coupon" placeholder="" value="no">
									@endif

									<div class="">
										<div class="form-group">
										<label>Chọn hình thức thanh toán</label>
										<select name="payment_select" class="form-control input-sm m-bot15 payment_select">
											<option value="0">Chuyển khoản ATM</option>
											<option value="1">Tiền mặt</option>
										
										</select>
                                </div>
									</div>
									<input type="button" value="Xác nhận đơn hàng" name="send_order" class="btn btn-primary btn-sm send_order">
								</form> 
								
							
							</div>
							
						</div>
					</div>
						<div class="col-sm-12 clearfix">
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
										<td>@if(Session::get('coupon'))
											<a class="btn btn-default check_out" href="{{url('/unset-coupon')}}">Xóa mã khuyến mãi</a>
											@endif</td>
										<td colspan="2">
											<li>Tổng:<span>{{number_format($total,0,',','.')}}VNĐ</span></li>
											<li>Thuế:<span>8%</span></li>
											@if(Session::get('coupon'))
											<li>
												
												@foreach(Session::get('coupon') as $key => $cou)
														@if($cou['coupon_condition']==1)
														Mã giảm: {{$cou['coupon_number']}}%
														<p>
															<?php
															$total_coupon=($total*$cou['coupon_number'])/100;
															
															?>
														</p>
														<p><?php
														$total_after_coupon=$total-$total_coupon;
														?></p>
														@elseif($cou['coupon_condition']==2)
														Mã giảm: {{number_format($cou['coupon_number'],0,',','.')}}VNĐ
														<p>
															<?php
															$total_coupon=$total-$cou['coupon_number'];
															
															?>
														</p>
														<?php
														$total_after_coupon=$total_coupon;
														?> 
														@endif
												@endforeach
												
												
												@endif

												
											</li>
											
											@if(Session::get('fee'))
											<li><a class="cart_quantity_delete" href="{{url('/del-fee')}}"><i class="fa fa-times"></i></a>
											Phí vận chuyển<span>{{number_format(Session::get('fee'),0,',','.')}}</span></li> 
											<?php
											$total_after_fee=$total+Session::get('fee');
											?>
											@endif
											<li>Tổng Còn:
											<?php
												if(Session::get('fee')&&!Session::get('coupon')){
													$total_after=$total_after_fee;
													echo number_format($total_after,0,',','.').'VNĐ';
												}elseif(!Session::get('fee')&&Session::get('coupon')){
													$total_after=$total_after_coupon;
													echo number_format($total_after,0,',','.').'VNĐ';
												}elseif(Session::get('fee')&&Session::get('coupon')){
													$total_after=$total_after_coupon;
													$total_after=$total_after+Session::get('fee');
													echo number_format($total_after,0,',','.').'VNĐ';
												}elseif(!Session::get('fee')&&!Session::get('coupon')){
													$total_after=$total;
													echo number_format($total_after,0,',','.').'VNĐ';
												}
											?>
											</li>
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
											<input type="text" class="form--control" name="coupon" placeholder="Nhập mã giảm giá"><br>
											<input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Tính mã giảm giá">
											
											</form>
										</td>
										</tr>
											@endif
								</table>
							</div>

						</div>		
				</div>
			</div>
			

			
			
		</div>
	</section> <!--/#cart_items-->

@endsection