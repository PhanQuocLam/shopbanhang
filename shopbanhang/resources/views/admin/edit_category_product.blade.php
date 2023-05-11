@extends('admin_layout');
@section('admin_content');
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Update Product
                        </header>
                        <div class="panel-body">
                            @foreach($edit_category_product as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-category-product/'.$edit_value->category_id)}}" method="POST">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name Product</label>
                                    <input type="text" value="{{$edit_value->category_name}}" class="form-control" name="category_product_name"id="exampleInputEmail1" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Description</label>
                                    <textarea style="resize: none" rows="8" value="" class="form-control" name="category_product_desc" id="exampleInputPassword1"  placeholder="">{{$edit_value->category_desc}}</textarea>
                                </div>
                                
                                
                                <button type="submit" name="add_category_product" class="btn btn-info">UPDATE</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>

            </div>
@endsection