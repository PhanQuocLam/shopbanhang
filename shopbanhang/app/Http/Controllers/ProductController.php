<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session ;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
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
    public function add_product()
    {
        $this->Authlogin();
        $cate_product=DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        
        return view('admin.add_product')->with('cate_product',$cate_product)->with('brand_product',$brand_product);
    }
    public function all_product()
    {
        $this->Authlogin();
        $all_product=DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->orderby('tbl_product.product_id','desc')->get();   
        $manager_product=view('admin.all_product')->with('all_product',$all_product);
        
        return view('admin_layout')->with('admin.all_product',$manager_product);
    }
    public function save_product(Request $request)
    {
        $this->Authlogin();

        $validator= Validator::make($request->all(),[
            'product_name' =>'required|min:3',
            'product_quantity' =>'required',
            'product_price' =>'required',
            'product_image' =>'required',
            'product_desc' =>'required',
            'product_content' =>'required'
            
        ], [
            'product_name.required' =>'Bạn cần nhập tên sản phẩm',
            'product_quantity.required' =>'Bạn cần số lượng sản phẩm',
            'product_price.required' =>'Bạn cần nhập giá sản phẩm',
            'product_image.required' =>'Bạn cần thêm ảnh sản phẩm',
            'product_desc.required' =>'Bạn cần nhập miêu tả sản phẩm',
            'product_content.required' =>'Bạn cần nhập nội dung sản phẩm',
            'product_name.min' =>'Tối thiểu 3 ký tự',
        ]); 
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        };
        $data = array();
        $data['product_name']=$request->product_name;
        $data['product_quantity']=$request->product_quantity;
        $data['product_sold']=0;
        $data['product_price']=$request->product_price;
        $data['product_desc']=$request->product_desc;
        $data['product_content']=$request->product_content;
        $data['category_id']=$request->product_cate;
        $data['brand_id']=$request->product_brand;
        $data['product_status']=$request->product_status;
        
        $get_image=$request->file('product_image');
        if($get_image){
            $get_name_image=$get_image->getClientOriginalName();
            $name_image=current(explode('.',$get_name_image));
            $new_image=$name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image']=$new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message','Seccessful');
            return Redirect::to('all-product');
            
        }
        $data['product_image']='';
        DB::table('tbl_product')->insert($data);
        Session::put('message','Seccessful');
        return Redirect::to('all-product');

    }
    public function unactive_product($product_id)
    {
        $this->Authlogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message','Not activation');
        return Redirect::to('all-product');
    }
    public function active_product($product_id)
    {
        $this->Authlogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message','Successful activation');
        return Redirect::to('all-product');
    }
    public function edit_product($product_id)
    {
        $this->Authlogin();
        $cate_product=DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        $edit_product=DB::table('tbl_product')->where('product_id',$product_id)->get();
        $manager_product=view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product)->with('brand_product',$brand_product);
        
        return view('admin_layout')->with('admin.edit_product',$manager_product);
    }
    public function update_product(Request $request,$product_id)
    {
        $this->Authlogin();
        $data = array();
        $data['product_name']=$request->product_name;
        $data['product_quantity']=$request->product_quantity;
        $data['product_price']=$request->product_price;
        $data['product_desc']=$request->product_desc;
        $data['product_content']=$request->product_content;
        $data['category_id']=$request->product_cate;
        $data['brand_id']=$request->product_brand;
        $data['product_status']=$request->product_status;
        $get_image =$request->file('product_image');

        if($get_image){
            $get_name_image=$get_image->getClientOriginalName();
            $name_image=current(explode('.',$get_name_image));
            $new_image=$name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image']=$new_image;
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            Session::put('message','Seccessful');
            return Redirect::to('all-product');
            
        }
        
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message','Seccessful');
        return Redirect::to('all-product');  
    }

    public function delete_product($product_id)
    {
        $this->Authlogin();
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message','Delete Successful');
        return Redirect::to('all-product');
    }

    //home
    public function details_product($product_id)
    {
        $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        
        $brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $details_product=DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_id',$product_id)->get(); 

        foreach ($details_product as $key =>$value) {
            $category_id=$value->category_id; 
        }

        $related_product=DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])->get(); 

        return view('pages.sanpham.show_details')->with('category',$cate_product)->with('brand',$brand_product)
        ->with('product_details',$details_product)->with('relate',$related_product);
    }
    

}
