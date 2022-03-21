@extends('layouts.child')
@section('title')
Staff DashBoard
@endsection
@section('staffarea')
<div class="container mt-3 ml-5">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select text-danger  fs-3 text-weight-bold" name="category_id"
                                aria-label="Default select example" id="category_id">
                                <option selected="selected">---- Select Category ----</option>
                                @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">
                                    {{ ($cat->name) }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="in_stock_id" class="form-label">Products</label>
                            <select class="form-select text-danger  fs-3 text-weight-bold" name="in_stock_id"
                                aria-label="Default select example" id="in_stock_id">
                                <option selected="selected">---- Select Product ----</option>
                                @foreach ($in_stocks as $in)
                                <option value="{{ $in->id }}">
                                    {{ ($in->name) }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 ">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="name" class="form-control" id="name" name="name" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="stock_quantity" class="text-danger fs-3"> Available Stock</label><br>
                            <input type="biginteger" class="form-control" id="stock_quantity" name="stock_quantity"
                                readonly>
                            <label for="quantity" class="form-label"> Quantity </label>&nbsp; &nbsp;&nbsp;
                            <label for="error" id="error" style="color: red"></label>
                            <input type="quantity" class="form-control changevalue" id="quantity" name="quantity"
                                onkeyup="categoryValidation()">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="biginteger" class="form-control changeQuantity" id="price" name="price">
                        </div>
                        <div class="mb-3">
                            <label for="total" class="form-label">Total</label>
                            <input type="biginteger" class="form-control " id="total" name="total">
                        </div>
                        <div class="mb-3">
                            <label for="">Product Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-danger">Add Product</button>
                    </form>
                    @if (session()->has('status'))
                    <div class="alert alert-success">
                        {{session('status')}}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="add_products">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="bx bx-plus-medical"></i>Add Product
        </button>
        <h2 class=" text-danger">Total Products</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Product</th>
                    <th scope="col">Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total</th>
                    <th scope="col">Category</th>
                    <th scope="col">Image</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $pro)
                <tr>
                    <th>{{$pro->id}}</th>
                    <th>{{$pro->in_stock_id}}</th>
                    <td>{{$pro->name}}</td>
                    <td>{{$pro->quantity}}</td>
                    <td>{{$pro->price}}</td>
                    <td>{{$pro->total}}</td>
                    <td>{{$pro->category_id}}</td>
                    <td>
                        <img src="{{ asset('uploads/products/'.$pro->image) }}" width="90px" height="70px" alt="Image">
                    </td>
                    <td>
                        <a href="{{ url('/editproduct', $pro->id) }}" class="btn btn-info btn-sm">Edit</a>
                        <a href="{{ url('/deleteproduct', $pro->id) }}" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(".changeQuantity").change(function(e){
            var quantity = $("#quantity").val();
            var price = $("#price").val();
            var total = quantity * price;
            $("#total").val(total);
        })
</script>
<script>
    $( "#in_stock_id" ).change(function () {  
    var id = $(this).val();

    $.ajax({
        url:'{{url('get_stocks') }}/'+id,
        type: 'get',
        dataType:'json',
        success: function($res){
            var name =JSON.parse(JSON.stringify($res.name));
            var  stock_quantity =JSON.parse(JSON.stringify($res.stock_quantity));
            $("#name").val(name);
            $("#stock_quantity").val(stock_quantity);
        }
    })
    });
</script>
@endsection


{{-- <div class="container mt-3 ml-5">
    <div class="col-sm-9">
        <div class="add_products">
            <h2 class=" text-danger">Adding Products</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 ">
                    <label for="name" class="form-label">Name</label>
                    <input type="name" class="form-control" id="name" name="name">
                </div>
                <div class="mb-3">
                    <input type="hidden" class="product_id" value="">
                    {{-- {{ $product['product_id'] }} --}}
                    {{-- <label for="quantity" class="form-label">Quantity</label>
                    <input type="biginteger" class="form-control changeQuantity" id="quantity" name="quantity">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="biginteger" class="form-control changeQuantity" id="price" name="price">
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Products</label>
                    <select class="form-select text-danger  fs-3 text-weight-bold" name="category_id"
                        aria-label="Default select example" id="category_id">
                        <option selected="selected">---- Select Category ----</option>
                        @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">
                            {{ ($cat->name) }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="total" class="form-label">Total</label>
                    <input type="biginteger" class="form-control " id="total" name="total">
                    {{-- {{ number_format($product['quantity'] * $product['price'], 2) }} --}}
                    {{-- {{ $product->quantity *$product->price }} --}}
                    {{--
                </div>
                <div class="mb-3">
                    <label for="">Product Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <button type="submit" class="btn btn-danger">Add Product</button>
            </form>
            @if (session()->has('status'))
            <div class="alert alert-success">
                {{session('status')}}
            </div>
            @endif
        </div>
    </div> --}}
    {{--
</div>
</div> --}}
{{-- <div class="container mt-5 ml-5">
    <div class="col-sm-9 mt-5 ">
        <div class="add_products">
            <h2 class=" text-danger">Total Products</h2>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Total</th>
                        <th scope="col">Category</th>
                        <th scope="col">Image</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $pro)
                    <tr>
                        <th>{{$pro->id}}</th>
                        <td>{{$pro->name}}</td>
                        <td>{{$pro->quantity}}</td>
                        <td>{{$pro->price}}</td>
                        <td>{{$pro->total}}</td>
                        <td>{{$pro->category_id}}</td>
                        <td>
                            <img src="{{ asset('uploads/products/'.$pro->image) }}" width="90px" height="70px"
                                alt="Image">
                        </td>
                        <td>
                            <a href="{{ url('/editproduct', $pro->id) }}" class="btn btn-info btn-sm">Edit</a>
                            <a href="{{ url('/deleteproduct', $pro->id) }}" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div> --}}
{{-- </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(".changeQuantity").change(function(e){
            var quantity = $("#quantity").val();
            var price = $("#price").val();
            var total = quantity * price;
            $("#total").val(total);
        })
</script> --}}