<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequests\CreateRequest;
use App\Http\Requests\ProductRequests\UpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductsController extends Controller
{
    //Auth olmadan bu sınıf icindeki fonksiyonlar kullanılamaz
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.index', ['products' => Product::paginate(7)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $product = new Product();

        $product_image = $request->product_image;
        $image_new_name = time() . $product_image->getClientOriginalName();
        $product_image->move('uploads/products', $image_new_name);

        $product->name = $request->product_name;
        $product->price = $request->product_price;
        $product->description = $request->product_desc;
        $product->image = 'uploads/products/' . $image_new_name;

        $product->save();

        session()->flash('success', 'Product Added');
        return redirect()->route('products.index');


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('products.edit')->with('product', Product::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($request->hasFile('product_image')) {

            $product_image = $request->product_image;
            $image_new_name = time() . $product_image->getClientOriginalName();
            $product_image->move('uploads/products', $image_new_name);
            $product->image = 'uploads/products/' . $image_new_name;

            $product->save();

        }

        $product->name = $request->product_name;
        $product->price = $request->product_price;
        $product->description = $request->product_desc;

        $product->save();

        session()->flash('success', 'Product Updated!');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        //if image is existing in storage remove it folder
        if(file_exists($product->image)){
            unlink($product->image);
        }
        $product->delete();
        session()->flash('success','Product removed');
        return redirect()->route('products.index');
    }
}
