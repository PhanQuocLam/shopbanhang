<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Models\Feeship;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Customer;
use App\Models\Product;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    public function update_qty(Request $request){
        $data=$request->all();
        $order_details=OrderDetails::where('product_id',$data['order_product_id'])->where('order_code',$data['order_code'])->first();
        $order_details->product_sales_quantity = $data['order_qty'];
        $order_details->save();
    }
    public function update_order_qty(Request $request){
        $data=$request->all();

        $order=Order::find($data['order_id']);
        $order->order_status=$data['order_status'];
        $order->save();
        if($order->order_status==2){
            foreach($data['order_product_id'] as $key =>$product_id){
                $product=Product::find($product_id);
                $product_quantity=$product->product_quantity;
                $product_sold=$product->product_sold;
                foreach($data['quantity'] as $key2 =>$qty){
                    if($key==$key2){
                        $pro_remain=$product_quantity-$qty;
                        $product->product_quantity=$pro_remain;
                        $product->product_sold=$product_sold+$qty;
                        $product->save();
                    }
                }
            }
        }elseif($order->order_status!=2&&$order->order_status!=3){
            foreach($data['order_product_id'] as $key =>$product_id){
                $product=Product::find($product_id);
                $product_quantity=$product->product_quantity;
                $product_sold=$product->product_sold;
                foreach($data['quantity'] as $key2 =>$qty){
                    if($key==$key2){
                        $pro_remain=$product_quantity+$qty;
                        $product->product_quantity=$pro_remain;
                        $product->product_sold=$product_sold-$qty;
                        $product->save();
                    }
                }
            }
        }
    }
    public function view_order($order_code){
        $order_details=OrderDetails::with('product')->where('order_code',$order_code)->get();
        $order=Order::where('order_code',$order_code)->get();
        foreach($order as $key => $ord){
            $customer_id=$ord->customer_id;
            $shipping_id=$ord->shipping_id;
            $order_status=$ord->order_status;

        }
        $customer=Customer::where('customer_id',$customer_id)->first();
        $shipping=Shipping::where('shipping_id',$shipping_id)->first();

        $order_details_product=OrderDetails::with('product')->where('order_code',$order_code)->get();

        foreach($order_details as $key =>$order_d){
            $product_coupon=$order_d->product_coupon;
            

        }
        if($product_coupon!='no'){
        $coupon=Coupon::where('coupon_code',$product_coupon)->first();
        $coupon_condition=$coupon->coupon_condition;
        $coupon_number=$coupon->coupon_number;
        }else{
            $coupon_condition=2;
            $coupon_number=0;
        }
        
        

        return view('admin.view_order')->with(compact('order_details','customer','order_details_product','shipping','coupon_condition','coupon_number','order','order_status'));
    }
    public function manage_order(){
        $order=Order::orderby('created_at','DESC')->get();
        return view('admin.manage_order')->with(compact('order'));
    }
    public function delete_order($order_id){
        DB::table('tbl_order')->where('order_id',$order_id)->delete();
        
        return Redirect::to('manage-order');
    }
}
