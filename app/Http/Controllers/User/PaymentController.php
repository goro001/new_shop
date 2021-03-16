<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
public function payment(Request $request){
     $validator = Validator::make($request->all(), [
            'id' => 'required|exists:products,id',
        ]);
        if ($validator->fails())
        {
            return response()->json(['status' => false,'data' => $validator->errors()]);
        } else {
            // Sets up the businesses secret key to receive the payment
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $product = Product::find($request->id);
            $shop = new Shop();
            $shop->user_id = Auth::id();
            $shop->product_id = $product->id;
            $shop->status = Shop::UNPAID;
            $shop->save();
            // Sets up payment method, and product information
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $product->name,
                        ],
                        'unit_amount' =>(float)$product->price*100,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => 'http://127.0.0.1:8000/payment/success/'.$shop->id,
                'cancel_url' => 'http://127.0.0.1:8000/payment/cancel',
            ]);
            return response()->json(['status' =>true,'id' => $session->id]);
        }
    }
    public function success($id){
     $shop = Shop::find($id);
        $shop->status = Shop::PAID;
        $shop->save();
        toastr()->success('vjarum@ hajoxutyamb katarvec');
        return Redirect::to(route('home'));
    }   
    public function cancel(){
     toastr()->error('vjarum@ hajoxutyamb chi katarvec');
        return Redirect::to(route('home'));
    }
}
