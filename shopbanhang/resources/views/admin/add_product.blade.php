@extends('admin_layout');
@section('admin_content');
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Product
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
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-product')}}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text"  value="{{old('product_name')}}"class="form-control" name="product_name"id="exampleInputEmail1" placeholder="">
                                </div>
                                @error('product_name')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng</label>
                                    <input type="text"  value="{{old('product_quantity')}}"class="form-control" name="product_quantity"id="exampleInputEmail1" placeholder="">
                                </div>
                                @error('product_quantity')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá</label>
                                    <input type="number" value="{{old('product_price')}}" class="form-control" name="product_price"id="exampleInputEmail1" placeholder="">
                                @error('product_price')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ảnh</label>
                                    <input type="file" value="{{old('product_image')}}" class="form-control" name="product_image"id="exampleInputEmail1" placeholder="">
                                @error('product_image')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Description</label>
                                    <textarea style="resize: none" rows="8"   class="form-control" name="product_desc" id="exampleInputPassword1" placeholder="">{{old('product_desc')}}</textarea>
                                @error('product_desc')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Content</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="product_content" id="exampleInputPassword1" placeholder="">{{old('product_content')}}</textarea>
                                @error('product_content')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label>Danh mục</label>
                                    <select name="product_cate" class="form-control input-sm m-bot15">
                                        @foreach($cate_product as $key => $cate)
                                        @if(old('product_cate')==$cate->category_id)
                                         <option  value="{{$cate->category_id}}" selected>{{$cate->category_name}}</option>
                                        @else
                                         <option  value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                        @endif
                                        @endforeach
                                        {
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Thương hiệu</label>
                                    <select name="product_brand" class="form-control input-sm m-bot15">
                                    @foreach($brand_product as $key => $brand)
                                    @if(old('product_brand')==$brand->brand_id)
                                        <option value="{{$brand->brand_id}}"selected>{{$brand->brand_name}}</option>
                                    @else  
                                        <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                    @endif
                                    @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                <label>Hiển thị</label>
                                    <select name="product_status" class="form-control input-sm m-bot15">
                                        <option value="1">Ẩn</option>
                                        <option value="0">Hiện</option>

                                    </select>
                                </div>
                                
                                <button type="submit" name="add_product" class="btn btn-info">ADD</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection