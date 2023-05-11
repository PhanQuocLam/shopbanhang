@extends('admin_layout');
@section('admin_content');
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm Danh Mục
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-category-product')}}" method="POST">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" class="form-control" name="category_product_name"id="exampleInputEmail1" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Miêu tả</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="category_product_desc" id="exampleInputPassword1" placeholder=""></textarea>
                                </div>
                                <div class="form-group">
                                    <select name="category_product_status" class="form-control input-sm m-bot15">
                                        <option value="1">Hide</option>
                                        <option value="0">Show</option>

                                    </select>
                                </div>
                                
                                <button type="submit" name="add_category_product" class="btn btn-info">Thêm</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection