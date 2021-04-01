@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="offset-2 col-md-8">
                <div class="card">
                    <div class="card-header">Add Product</div>
                    <div class="card-body">
                        <div class="form-group">
                            <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <label for="product_name">Product Name :</label>
                                <input type="text" name="product_name" id="product_name" class="form-control" value="{{old('product_name')}}">

                                <label for="product_price">Product Price :</label>
                                <input class="form-control" type="number" name="product_price" id="product_price" value="{{old('product_price')}}">

                                <label for="product_image">Product Image :</label>
                                <input class="form-control" type="file" name="product_image" id="product_image">

                                <label for="product_desc">Product Description:</label>
                                <textarea class="form-control" name="product_desc" id="product_desc" cols="3"
                                          rows="3"></textarea>
                                <button type="submit" class="btn btn-primary btn-sm my-2">Add Product</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

