<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Quần áo đẹp</title>
    <link href="{{asset('public/fontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/fontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/fontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/fontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/fontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('public/fontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('public/fontend/css/responsive.css')}}" rel="stylesheet">
	<link href="{{asset('public/fontend/css/sweetalert.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{('public/fontend/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
<?php use Illuminate\Support\Facades\Session ;?>	
	
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +84 123456789</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> lam@gmail.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
	
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.html"><img src="{{('public/fontend/images/home/logo.png')}}" alt="" /></a>
						</div>
						<div class="btn-group pull-right">
							
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								
								
								<?php
									
									$customer_id=Session::get('customer_id');
		
									$shipping_id= Session::get('shipping_id');
									if($customer_id!=NULL&&$shipping_id==NULL){
								?>
								<li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i>Thanh toán</a></li>
								
								<?php
							}elseif($customer_id!=NULL&&$shipping_id!=NULL){
								?>
								<li><a href="{{URL::to('/payment')}}"><i class="fa fa-lock"></i>Thanh toán</a></li>
								<?php
							}else{
								?>
								<li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i>Thanh toán</a></li>
								
								
								<?php
							}
							?>
							<li><a href="{{URL::to('/gio-hang')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
							<?php		
									$customer_id=Session::get('customer_id');
									if($customer_id!=NULL){
								?>
								<li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i>Đăng xuất</a></li>
								
								<?php
							}else{
								?>
								<li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i>Đăng nhập</a></li>
								<?php
							}
								?>	
								
										
								</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{URL::to('/trang-chu')}}" class="active">Trang chủ</a></li>
								<li class="dropdown"><a href="#">Sản Phẩm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
									@foreach($category as $key =>$cate)
                                        <li>
										
										<a href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a>
							
										
						</li>
						@endforeach
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Tin Yức<i class="fa fa-angle-down"></i></a>
                                </li> 
								<li><a href="{{URL::to('/show-cart')}}">Giỏ Hàng</a></li>
								<li><a href="contact-us.html">Liên Hệ</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-4">
						<form action="{{URL::to('/tim-kiem')}}" method="POST">
							{{csrf_field()}}
						<div class="search_box pull-right">
							<input type="text" name="keywords_submit" placeholder="Tìm kiếm sản phẩm"/>
							<input type="submit" name="search_item" style="margin-top:0;" class="btn btn-primary btn-sm" value="Tìm Kiếm">
						</div>
						</form>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner">
							<div class="item active">
								<div class="col-sm-6">
									<h1><span>SHOP</span>-STAR</h1>
									<h2>SHOP STAR luôn mong muốn mang đến những giá trị và lợi ích tốt nhất cho Khách hàng bằng những sản phẩm Quần áo thời trang Thể thao Nam nữ Đẹp, Cao cấp, Chất lượng tốt với Giá thành tốt nhất</h2>
									<p>Thương hiệu xịn đẹp và rẻ </p>
									
								</div>
								<div class="col-sm-6">
									<img src="{{('public/fontend/images/girl1.jpg')}}" class="girl img-responsive" alt="" />
									<img src="{{('public/fontend/images/pricing.png')}}"  class="pricing" alt="" />
								</div>
							</div>
							<div class="item">
								<div class="col-sm-6">
									<h1><span>SHOP</span>-STAR</h1>
									<h2>SHOP STAR luôn mong muốn mang đến những giá trị và lợi ích tốt nhất cho Khách hàng bằng những sản phẩm Quần áo thời trang Thể thao Nam nữ Đẹp, Cao cấp, Chất lượng tốt với Giá thành tốt nhất</h2>
									<p>Thương hiệu xịn đẹp và rẻ </p>									
								</div>
								<div class="col-sm-6">
									<img src="{{('public/fontend/images/girl2.jpg')}}" class="girl img-responsive" alt="" />
									<img src="{{('public/fontend/images/pricing.png')}}"  class="pricing" alt="" />
								</div>
							</div>
							
							<div class="item">
								<div class="col-sm-6">
									<h1><span>SHOP</span>-STAR</h1>
									<h2>SHOP STAR luôn mong muốn mang đến những giá trị và lợi ích tốt nhất cho Khách hàng bằng những sản phẩm Quần áo thời trang Thể thao Nam nữ Đẹp, Cao cấp, Chất lượng tốt với Giá thành tốt nhất</h2>
									<p>Thương hiệu xịn đẹp và rẻ </p>									
								</div>
								<div class="col-sm-6">
									<img src="{{('public/fontend/images/girl3.jpg')}}" class="girl img-responsive" alt="" />
									<img src="{{('public/fontend/images/pricing.png')}}" class="pricing" alt="" />
								</div>
							</div>
							
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Danh Mục Sản Phẩm</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							@foreach($category as $key =>$cate)
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a></h4>
								</div>
							</div>
							@endforeach
						</div><!--/category-products-->
					
						<div class="brands_products"><!--brands_products-->
							<h2>Thương Hiệu </h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
								@foreach($brand as $key =>$brand)
									<li><a href="{{URL::to('/thuong-hieu-san-pham/'.$brand->brand_id)}}"> <span class="pull-right"></span>{{$brand->brand_name}}</a></li>
								@endforeach
								</ul>
							</div>
						</div><!--/brands_products-->
						<div class="brands_products"><!--brands_products-->
							<h2>Sắp xếp theo giá sản phẩm </h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">						
									<li><a href="{{URL::to('/sap-xep-desc')}}"> <span class="pull-right"></span>Giá từ cao tới thấp</a></li>
									<li><a href="{{URL::to('/sap-xep-asc')}}"> <span class="pull-right"></span>Giá từ thấp tới cao</a></li>
								</ul>
							</div>
						</div>
						
					
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					@yield('content')
							
				</div>
			</div>
		</div>
	</section>
	
	<footer id="footer"><!--Footer-->
		
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	

  
    <script src="{{asset('public/fontend/js/jquery.js')}}"></script>
	<script src="{{asset('public/fontend/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('public/fontend/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('public/fontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/fontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/fontend/js/main.js')}}"></script>
	<script src="{{asset('public/fontend/js/sweetalert.min.js')}}"></script>
	<script src="{{asset('public/fontend/js/alter.js')}}"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('.send_order').click(function(){
				
				swal({
					title: "Xác nhận đơn hàng",
					text: "Đơn hàng sẽ không được hoàn trả khi đặt,bạn có muốn đặt không?",
					type: "warning",
					showCancelButton: true,
					confirmButtonClass: "btn-danger",
					confirmButtonText: "Cảm ơn,mua hàng",
					cancelButtonText: "Đóng,chưa mua",
					closeOnConfirm: false,
					closeOnCancel: false
					},
					function(isConfirm){
						if(isConfirm){
							var shipping_email=$('.shipping_email').val();
							var shipping_name=$('.shipping_name').val();
							var shipping_address=$('.shipping_address').val();
							var shipping_phone=$('.shipping_phone').val();
							var shipping_notes=$('.shipping_notes').val();
							var shipping_method=$('.payment_select').val();
							var order_fee=$('.order_fee').val();
							var order_coupon=$('.order_coupon').val();
							$.ajax({
								
								url: "{{route('confirm.order')}}",
								method:'POST',
								
								data:{
									
									shipping_email:shipping_email,
									shipping_name:shipping_name,
									shipping_address:shipping_address,
									shipping_phone:shipping_phone,
									shipping_notes:shipping_notes,
									order_fee:order_fee,
									order_coupon:order_coupon,
									shipping_method:shipping_method,
									_token:"{{ csrf_token() }}",
									
								},
								success:function()
								{
									swal("Đơn hàng", "Đơn hàng của bạn đã được đặt thành công", "success");
								}
							});
							window.setTimeout(function(){
								location.reload();
							},3000);
							
						}else{
							swal("Đóng", "Đơn hàng của bạn chưa được gửi,làm ơn hoàn thành đơn hàng", "error");
						}
					
					});
				
				
			});
		});


	</script>

	<script type="text/javascript">
	 
		$(document).ready(function(){
			$('.add-to-cart').click(function(){
				
				var id=$(this).data('id_product');
				var cart_product_id=$('.cart_product_id_'+id).val();
				var cart_product_name=$('.cart_product_name_'+id).val();
				var cart_product_image=$('.cart_product_image_'+id).val();
				var cart_product_price=$('.cart_product_price_'+id).val();
				var cart_product_qty=$('.cart_product_qty_'+id).val();
				$.ajax({
					
					url: "{{route('cart.add')}}",
					method:'POST',
					
					data:{
						
						cart_product_id:cart_product_id,
						cart_product_name:cart_product_name,
						cart_product_image:cart_product_image,
						cart_product_price:cart_product_price,
						cart_product_qty:cart_product_qty,
						_token:"{{ csrf_token() }}",
						
					},
					success:function()
					{
						swal({
							title: "Đã thêm sản phẩm vào giỏ hàng",
							text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
							showCancelButton: true,
							cancelButtonText: "Xem tiếp",
							confirmButtonClass: "btn-success",
							confirmButtonText: "Đi đến giỏ hàng",
							closeOnConfirm: false
							},
							function() {
							window.location.href = "{{url('/gio-hang')}}";
							});
					}
				});
				
			});
		});

	</script> 
	<script type="text/javascript">
		$(document).ready(function(){
			$('.choose').on('change',function(){
                var action =$(this).attr('id');
                var ma_id=$(this).val();

                var result='';
                if(action=='city'){
                    result='province';
                }else{
                    result='wards';
                }
                $.ajax({
                    url: "{{route('select.deliveryhome')}}",
                    method:'POST',
                    data:{
                        action:action,
                        ma_id:ma_id,
                        _token:"{{ csrf_token() }}",
                    },
                    success:function(data){
                        $('#'+result).html(data);
                    }
                });

            });
		});
		

	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.calculate_delivery').click(function(){
				var matp=$('.city').val();
				var maqh=$('.province').val();
				var xaid=$('.wards').val();
				
				if(matp==''&&maqh==''&&xaid==''){
					alert('Làm ơn chọn để tính phí vận chuyển')
				}else{
				$.ajax({
                    url: "{{route('calculate.fee')}}",
                    method:'POST',
                    data:{
                        matp:matp,
                        maqh:maqh,
						xaid:xaid,
                        _token:"{{ csrf_token() }}",
                    },
                    success:function(data){
                        location.reload();
                    }
				
                });

				}
			});
		});
	</script>
</body>
</html>