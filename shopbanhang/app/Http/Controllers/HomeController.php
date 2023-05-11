<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
class HomeController extends Controller
{
    public function index(){
        $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $all_product=DB::table('tbl_product')->where('product_status','0')->orderby('product_id','desc')->paginate(6);
        
        return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product);
    }
    public function search(Request $request){
        $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
        $keywords=$request->keywords_submit;
        $search_product=DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get();

        
        return view('pages.sanpham.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product);

    }
    public function sap_xep_desc(){
        $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $all_product=DB::table('tbl_product')->where('product_status','0')->orderby('product_price','desc')->paginate(6);
        
        return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product);
    }
    public function sap_xep_asc(){
        $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $all_product=DB::table('tbl_product')->where('product_status','0')->orderby('product_price','asc')->paginate(6);
        
        return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product);
    }
     
}
