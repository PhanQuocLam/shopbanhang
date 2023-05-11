@extends('admin_layout');
@section('admin_content');
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Brand Product
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-brand-product')}}" method="POST">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên thương hiệu</label>
                                    <input type="text" value="{{old('brand_product_name')}}" class="form-control" name="brand_product_name"id="exampleInputEmail1" placeholder="">
                                @error('brand_product_name')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Miêu tả</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="brand_product_desc" id="exampleInputPassword1" placeholder="">{{old('brand_product_desc')}}</textarea>
                                @error('brand_product_desc')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <select name="brand_product_status" class="form-control input-sm m-bot15">
                                        <option value="1">Hide</option>
                                        <option value="0">Show</option>

                                    </select>
                                </div>
                                
                                <button type="submit" name="add_brand_product" class="btn btn-info">ADD</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection