@extends('welcome')
@section('content')

<div class="features_items">
	<!--features_items-->
						@foreach($category_name as $key =>$name)
						<h2 class="title text-center">{{$name->category_name}}</h2>
						@endforeach
						@foreach($category_by_id as $key =>$product)
						<div class="col-sm-4">
							<div class="product-image-wrapper">
							
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{URL::to('public/uploads/product/'.$product->product_image)}}"height="100" weight="100" alt="" />
											<h2>{{number_format($product->product_price).' '.'VND'}}</h2>
											<p>{{$product->product_name}}</p>
											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<h2>{{number_format($product->product_price).' '.'VND'}}</h2>
												<p>{{$product->product_name}}</p>
												<a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Chi Tiết Sản Phẩm</a>
											</div>
										</div>
								</div>

								
							</div>
						</div>
						@endforeach
						
						
						
				
						
					</div><!--features_items-->
                    <div class="paginationWrap" align="center">			 
					{!! $category_by_id->links() !!}
		            

		 			</div>
					
@endsection