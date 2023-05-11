@extends('admin_layout');
@section('admin_content');
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm mã giảm giá
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/insert-coupon-code')}}" method="POST">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên mã giảm giá</label>
                                    <input type="text" class="form-control" name="coupon_name"id="exampleInputEmail1" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mã giảm giá</label>
                                    <input type="text" class="form-control" name="coupon_code"id="exampleInputEmail1" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số lượng mã</label>
                                    <input type="text" class="form-control" name="coupon_time"id="exampleInputEmail1" placeholder="">                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tính năng mã</label>
                                    <select name="coupon_condition" class="form-control input-sm m-bot15">
                                        <option value="0">----Chọn----</option>
                                        <option value="1">Giảm theo phần trăm</option>
                                        <option value="2">Giảm theo tiền</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nhập số % hoặc tiền giảm</label>
                                    <input type="text" class="form-control" name="coupon_number"id="exampleInputEmail1" placeholder="">                                </div>
                                </div>
                                 
                                <button type="submit" name="add_category_product" class="btn btn-info">Thêm mã</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection