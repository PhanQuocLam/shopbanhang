@extends('admin_layout');
@section('admin_content');
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm mã vận chuyển
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-brand-product')}}" method="POST">
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
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phí vận chuyển</label>
                                    <input type="text" value="{{old('brand_product_name')}}" class="form-control fee_ship" name="fee_ship"id="exampleInputEmail1" placeholder="">
                                </div>
                                <button type="button" name="add_delivery" class="btn btn-info add_delivery">Thêm phí vận chuyển</button>
                            </form>
                            </div>
                            <div id="load_delivery">

                            </div>

                        </div>
                    </section>

            </div>
@endsection