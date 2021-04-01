<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ShoppingCardController extends Controller
{
    public function add_to_cart(){
        $product = new Product();

        $product = $product->find(request()->productId);

        $cartItem = Cart::add([
            'id'=>$product->id,
            'name'=>$product->name,
            'qty'=>request()->qty,
            'price'=>$product->price
        ]);

        //dd(Cart::content()); //view the cart content

        Cart::associate($cartItem->rowId,'App\Models\Product' ); //to display image ,related Cart and Database Model

        session()->flash('message','Book added to cart!');

        return redirect()->route('cart');


    }

    public function cart(){
        return view('cart');
    }

    public function delete_item($id){
        Cart::remove($id);
        session()->flash('info','Book removed from cart');
        return redirect()->back();
    }

    public function cart_decrement($id,$qty){

        Cart::update($id , $qty-1);
        session()->flash('info','Book quantity decremented');
        return redirect()->back();
    }

    public function cart_increment($id,$qty){

        Cart::update($id,$qty+1);
        session()->flash('info','Book quantity incremented');
        return redirect()->back();
    }

    public function rapid_add($id){

        $product = Product::find($id);

       $data = Cart::add([
            'id'=>$product->id,
            'name'=>$product->name,
            'qty'=>1,
            'price'=>$product->price,
        ])->associate('App\Models\Product');
        session()->flash('message','Book added to cart!');
        return redirect()->back();;
    }
}
