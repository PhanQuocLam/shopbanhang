@extends('admin_layout');
@section('admin_content');
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Update Product
                        </header>
                        <?php
                            use Illuminate\Support\Facades\Session ;
                            $message= Session::get('message');
                            if($message){
                            echo $message;
                            Session::put('message',null);
                             }
                        ?>
                        <div class="panel-body">
                            @foreach($edit_product as $key => $pro)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-product/'.$pro->product_id)}}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" class="form-control" name="product_name"id="exampleInputEmail1" placeholder="" 
                                    value ="{{$pro->product_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng</label>
                                    <input type="text" class="form-control" name="product_quantity"id="exampleInputEmail1" placeholder="" 
                                    value ="{{$pro->product_quantity}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá</label>
                                    <input type="text" class="form-control" name="product_price"id="exampleInputEmail1" placeholder=""
                                    value ="{{$pro->product_price}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ảnh</label>
                                    <input type="file" class="form-control" name="product_image"id="exampleInputEmail1" placeholder="">
                                    <img src="{{URL::to('public/uploads/product/'.$pro->product_image)}}" height="100" width="100">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Miêu tả</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="product_desc" id="exampleInputPassword1" placeholder=""
                                    >{{$pro->product_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="product_content" id="exampleInputPassword1" placeholder=""
                                    >{{$pro->product_content}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Category</label>
                                    <select name="product_cate" class="form-control input-sm m-bot15">
                                        @foreach($cate_product as $key => $cate)
                                            @if($cate->category_id==$pro->category_id)
                                            <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                            @else
                                            <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Brand</label>
                                    <select name="product_brand" class="form-control input-sm m-bot15">
                                    @foreach($brand_product as $key => $brand)
                                        @if($brand->brand_id==$pro->brand_id)
                                        <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                        @else
                                            <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                            @endif
                                    @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="product_status" class="form-control input-sm m-bot15">
                                        <option value="1">Hide</option>
                                        <option value="0">Show</option>

                                    </select>
                                </div>
                                
                                <button type="submit" name="add_product" class="btn btn-info">Update</button>
                            </form>
                            @endforeach
                            </div>
                             
                        </div>
                    </section>

            </div>
@endsection