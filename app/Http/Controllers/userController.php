<?php

namespace App\Http\Controllers;

use App\Http\Requests\confirmOrder;
use App\Models\Order;
use App\Models\prducts;
use App\Models\productCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

use Stripe;

class userController extends Controller
{
    //
    public function check(){
        if(Auth::check()){
            if(Auth::user()->user_type == 'user'){
               return view('dashboard');
            }else{
                return view('admin.dashboard');
            }
        }
    }

     public function deleteOrder($id){
        if(Auth::check()){
            if(Auth::user()->user_type == 'user'){
                $data = productCart::findOrFail($id);
                if($data != null){
                    $data->delete();
                    return redirect()->back()->with('success','Order delete Successfully');
                }

            }
        }
    }

       public function addCard($id){
        $idProduct = prducts::findOrFail($id);
        if( $idProduct != null){
            $data = new productCart();
            $data->user_id = Auth::id();
            $data->product_id = $id;
            $data->save();
            return back()->with('success','product add successfully for your card');
        }
            return back()->with('error','product not add  for your card ');


      }


    public function showCatrs(){
        $price = 0;
        if(Auth::check()){
            if(Auth::user()->user_type == 'user'){
                $data = productCart::where('user_id','=',Auth::id())->get();
                foreach($data as $item){
                    $item->name_pr = prducts::where('id','=',$item->product_id)->value('name');
                    $item->image = prducts::where('id','=',$item->product_id)->value('product_image');
                    $item->description = prducts::where('id','=',$item->product_id)->value('description');
                    $item->price = prducts::where('id','=',$item->product_id)->value('price');
                    $priceOne = prducts::where('id','=',$item->product_id)->value('price');

                    $price = $price +  $priceOne ;
                    $itemAction = Order::where('product_id','=',$item->product_id)->exists();
                    if($itemAction){
                        $item->status = '';
                    }else{
                        $item->status = ' ';
                    }
                }

                return view('admin.view_carts',['data'=>$data,'count' => '','price' => $price]);
            }
        }
    }

    public function confirmOrderAll(confirmOrder $request){
        $cart_product = productCart::where('user_id','=',Auth::id())->get();

        foreach($cart_product as $id_product){
            $data = new Order();
            $data->address = $request->address;
            $data->phone = $request->phone;
            $data->user_id = Auth::id();
            $data->product_id = $id_product->product_id;
            $data->save();
        }
        $cart = productCart::where('user_id','=',Auth::id())->get();
       foreach( $cart as $cart2){
            $cart_id = productCart::findOrFail($cart2->id);
            $cart_id->delete();
       }
        return redirect()->back()->with('success','Order is Confirmed successfully');
    }


      public function  MyOrders2(){
        $data = Order::where('user_id','=',Auth::id())->get();

         foreach($data as $item){
            $item->name_p = prducts::where('id','=',$item->product_id)->value('name');
        }

        return view('my_orders',['data'=>$data]);
      }

          public function stripe($price)

    {
        $price1 = $price;
        return view('stripe',compact('price1'));

    }

         public function stripe2($price)

    {
        $price1 = $price;
        return view('stripe',['price1' => $price1]);

    }

     public function stripePost(Request $request)

    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));



        Stripe\Charge::create ([

                "amount" => 100 * 100,

                "currency" => "usd",

                "source" => $request->stripeToken,

                "description" => "Test payment from itsolutionstuff.com."

        ]);


         $cart_product = productCart::where('user_id','=',Auth::id())->get();

        foreach($cart_product as $id_product){
            $data = new Order();
            $data->address = $request->address;
            $data->phone = $request->phone;
            $data->user_id = Auth::id();
            $data->payment_status = 'paid';
            $data->product_id = $id_product->product_id;
            $data->save();
        }
        $cart = productCart::where('user_id','=',Auth::id())->get();
       foreach( $cart as $cart2){
            $cart_id = productCart::findOrFail($cart2->id);
            $cart_id->delete();
       }

        return redirect()->back()->with('success', 'Payment successful!');



        // return back();

    }
}
