@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="offset-2 col-md-8">
            <div class="card">
                <div class="card-header">Edit Product</div>
                <div class="card-body">
                    <div class="form-group">
                        <form action="{{route('products.update',$product->id)}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <label for="product_name">Product Name :</label>
                            <input type="text" name="product_name" id="product_name" class="form-control" value="{{$product->name}}">

                            <label for="product_price">Product Price :</label>
                            <input class="form-control" type="number" name="product_price" id="product_price" value="{{$product->price}}">

                            <p>Installed image:</p>
                            <img src="{{asset($product->image)}}" class="m-2" width="100px" height="75px">
                            <input class="form-control" type="file" name="product_image" id="product_image">

                            <label for="product_desc">Product Description:</label>
                            <textarea class="form-control" name="product_desc" id="product_desc" cols="3"
                                      rows="3">{{$product->description}} </textarea>
                            <button type="submit" class="btn btn-primary btn-sm my-2">Edit Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


