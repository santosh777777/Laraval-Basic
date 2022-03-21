@extends('layouts.master')
@section('title')
Admin DashBoard |Instock
@endsection
@section('sidebar')
<div class="container ml-3">
    <div class="in_stock">
        <div class="row">
            <div class="col-sm-12">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success mb-4" data-bs-toggle="modal"
                    data-bs-target="#exampleModal"><i class="bx bx-plus-medical"></i>
                    Add Product
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Products</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST">
                                    @csrf
                                    <div class="mb-3 ">
                                        <label for="name" class="form-label">Product Name</label>
                                        <input type="name" class="form-control" id="name" name="name">
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input type="quantity" class="form-control" id="quantity" name="quantity">
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="supplier" class="form-label">Supplier Name</label>
                                        <input type="supplier" class="form-control" id="supplier" name="supplier">
                                    </div>
                                    {{-- <div class="qrcode">
                                        {!! QrCode::size(200)->generate(
                                        "Product ID:$Instock->id, Product Name:$Instock->name,
                                        Quantity:$Instock->quantity, Date: $Instock->date"
                                        ); !!}
                                    </div> --}}
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
                <h5 class=" text-dark">Available Stock</h5>
                <table class="table table-hover">
                    <thead>
                        <tr class="text-danger">
                            <th scope="col">ID</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Supplier</th>
                            {{-- <th scope="col">Qr Code</th> --}}
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Instocks as $in)
                        <tr>
                            <th>{{$in->id}}</th>
                            <td>{{$in->name}}</td>
                            <td>{{$in->quantity}}</td>
                            <td>{{$in->supplier}}</td>
                            {{-- <td>
                                <div class="qrcode">
                                    {!! QrCode::size(60)->generate(
                                    "Product ID:$in->id, Product Name:$in->name, Quantity:$in->quantity, Date:
                                    $in->created_at"
                                    ); !!}
                                </div>
                            </td> --}}
                            <td>
                                <a href="{{ url('/editinstock', $in->id) }}" class="btn btn-info btn-sm">Edit</a>
                                {{-- <a href="{{ url('/deleteinstock', $in->id) }}"
                                    class="btn btn-danger btn-sm">Delete</a> --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection