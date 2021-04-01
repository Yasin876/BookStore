@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header"><h4>Products List</h4></div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>Count</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 0; ?>
                @foreach($products as $product)
                    <tr>
                        <td><strong>{{++$i}}</strong></td>
                        <td><img src="{{asset($product->image)}}" width="90px" height="150px"
                                 style="border-radius: 10px;"></td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->price}}$</td>
                        <td><a href="{{route('products.edit',$product->id)}}" class="btn btn-primary btn-sm">Edit</a>
                        </td>
                        <td>
                            <form action="{{route('products.destroy',$product->id)}}" method="POST">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                </tbody>

            </table>
            {{$products->links('pagination::bootstrap-4')}}
        </div>
    </div>


@endsection
