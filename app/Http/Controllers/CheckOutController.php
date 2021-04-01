<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Mail;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckOutController extends Controller
{
    public function index(){
        if(Cart::content()->count()==0){
            session()->flash('warning','Your cart is empty!');
            return redirect()->back();
        }

        return view('checkout');
    }

    public function pay(){
       Stripe::setApiKey('sk_test_51IaJrPDZt6lMZP06mCEm9C6unPKd20qQn7DbKVJ2DlSVJ2j8V9lQcLhDLrsxewZQPl33g8WfmYopgOz0YX2Oiokx009zQdUu59');
       $token = request()->stripeToken;

       $charge = \Stripe\Charge::create([
        'amount' =>Cart::total()*100,
        'currency' => 'usd',
        'description'=>'Book e-commerce',
        'source' =>$token,
      ]);

       session()->flash('message','Payment is success ,thanks for your shopping!!');

       Cart::destroy();

      //to send email to the user
      Mail::to(request()->stripeEmail)->send(new \App\Mail\PaymentSuccess);

       return redirect()->route('index');
    }
}
