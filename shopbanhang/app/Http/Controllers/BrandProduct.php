<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session ;
use Illuminate\Support\Facades\Validator;

class BrandProduct extends Controller
{
    public function Authlogin()
    {
        $admin_id =Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_brand_product()
    {
        $this->Authlogin();
        return view('admin.add_brand_product');
    }
    public function all_brand_product()
    {
        $this->Authlogin();
        $all_brand_product=DB::table('tbl_brand')->get();
        $manager_brand_product=view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
        
        return view('admin_layout')->with('admin.all_brand_product',$manager_brand_product);
    }
    public function save_brand_product(Request $request)
    {
        $this->Authlogin();
        
        $validator= Validator::make($request->all(),[
            'brand_product_name' =>'required|min:3',
            'brand_product_desc' =>'required',
           
        ], [
            'brand_product_name.required' =>'Bạn cần nhập tên thương hiệu',
            'brand_product_desc.required' =>'Bạn cần nhập miêu tả thương hiệu',
            
            'brand_product_name.min' =>'Tối thiểu 3 ký tự',
        ]); 
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $data = array();
        $data['brand_name']=$request->brand_product_name;
        $data['brand_desc']=$request->brand_product_desc;
        $data['brand_status']=$request->brand_product_status;

        DB::table('tbl_brand')->insert($data);
        Session::put('message','Seccessful');
        return Redirect::to('all-brand-product');

    }
    public function unactive_brand_product($brand_product_id)
    {
        $this->Authlogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status'=>1]);
        Session::put('message','Not activation');
        return Redirect::to('all-brand-product');
    }
    public function active_brand_product($brand_product_id)
    {
        $this->Authlogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status'=>0]);
        Session::put('message','Successful activation');
        return Redirect::to('all-brand-product');
    }
    public function edit_brand_product($brand_product_id)
    {
        $this->Authlogin();
        $edit_brand_product=DB::table('tbl_brand')->where('brand_id',$brand_product_id)->get();
        $manager_brand_product=view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product);
        
        return view('admin_layout')->with('admin.edit_brand_product',$manager_brand_product);
    }
    public function update_brand_product(Request $request,$brand_product_id)
    {
        $this->Authlogin();
        $data = array();
        $data['brand_name']=$request->brand_product_name;
        $data['brand_desc']=$request->brand_product_desc;
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update($data);
        Session::put('message','Update Successful');
        return Redirect::to('all-brand-product');   
    }

    public function delete_brand_product($brand_product_id)
    {
        $this->Authlogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->delete();
        Session::put('message','Delete Successful');
        return Redirect::to('all-brand-product');
    }

    //function-home
    public function show_brand_home($brand_id)
    {
        $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        
        $brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $brand_by_id =DB::table('tbl_product')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_product.brand_id',$brand_id)->paginate(6);
        
        $brand_name =DB::table('tbl_brand')->where('tbl_brand.brand_id',$brand_id)->limit(1)->get();

        return view('pages.brand.show_brand')->with('category',$cate_product)->with('brand',$brand_product)
        ->with('brand_by_id',$brand_by_id)->with('brand_name',$brand_name);
    }

}
