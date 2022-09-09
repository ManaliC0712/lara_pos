@extends('layouts.app')

@section('content')

<div class="container fluid">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left">Add Product</h4> 
                        <a href="#" style="float: right" class="btn btn-dark"
                        data-toggle="modal" data-target="#addproduct">
                        <i class="fa fa-plus"></i> Add New Product</a></div>
                        <div class="card-body">
                            <table class="table table-bordered table-left">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th>Brand</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Alert Stock</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $key => $product)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->brand }}</td>
                                        <td>{{ number_format($product->price,2) }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>
                                            @if ($product->alert_stock >= $product->quantity)
                                            <span class="badge badge-danger"> Low Stock-> 
                                                {{ $product->alert_stock }}</span>
                                            @else
                                            <span class="badge badge-success"> {{ $product->alert_stock }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-info btnt-sm" data-toggle="modal" data-target="#editproduct{{ $product->id }}">
                                                    <i class="fa fa-edit"></i>Edit</a>
                                                <a href="#" data-toggle="modal"
                                                data-target="#deleteproduct{{ $product->id}}" class="btn btn-sm btn-danger">
                                                <i class="fa fa-trash"></i>Del</a>
                                            </div>
                                        </td>
                                    </tr>


                                    <!-- Modal of Edit product -->
                                    <div class="modal right fade" id="editproduct{{ $product->id }}" data-backdrop="static" data-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="staticBackdropLabel">Edit product</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    {{ $product->id }}
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ url('products', $product->id) }}" method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <div class="form-group">
                                                            <lable for="">Product Name</lable>
                                                            <input type="text" name="product_name" id="" value="{{ $product->product_name}}" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <lable for="">Brand</lable>
                                                        <input type="text" name="brand" id="" value="{{ $product->brand}}" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <lable for="">Price</lable>
                                                            <input type="number" name="price" id="" value="{{ $product->price}}" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <lable for="">Quantity</lable>
                                                            <input type="number" name="quantity" id="" value="{{ $product->quantity}}" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <lable for="">Alert Stock</lable>
                                                            <input type="number" name="alert_stock" id="" value="{{ $product->alert_stock}}" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <lable for="">Description</lable>
                                                            <textarea name="description" id="" cols="30" rows="2" class="form-control">{{ $product->description }}</textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-primary btn-block">Update product</button>
                                                        </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal of delete product -->
                                    <div class="modal right fade" id="deleteproduct{{ $product->id }}" data-backdrop="static" data-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                    <h4 class="modal-title" id="staticBackdropLabel">Delete product</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    {{ $product->id }}
                                            </div>
                                            <div class="modal-body">
                                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <p>Are you sure you want to delete this {{ $product->product_name }}?</p>
                                                    
                                                        <div class="modal-footer">
                                                            <button class="btn btn-info" data-dismiss="modal">Cancle</button>
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </div>
                                                    </form>
                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                    @endforeach
                                    {{ $products->links() }}

                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
            <div class="col-md-3">
            <div class="card">
                <div class="card-header"><h4>Search product</h4></div>
                    <div class="card-body">
                        ..........
                    </div>
            </div>
            </div>
        </div>
    </div>
</div>

<!-- Model Of adding new product -->
<!-- Modal -->
<div class="modal right fade" id="addproduct" data-backdrop="static" data-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="staticBackdropLabel">Add product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <form action="{{ url('products') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <lable for="">Product Name</lable>
                            <input type="text" name="product_name" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <lable for="">Brand</lable>
                        <input type="text" name="brand" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <lable for="">Price</lable>
                            <input type="number" name="price" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <lable for="">Quantity</lable>
                            <input type="number" name="quantity" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <lable for="">Alert Stock</lable>
                            <input type="number" name="alert_stock" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <lable for="">Description</lable>
                            <textarea name="description" id="" cols="30" rows="2"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary btn-block">Save product</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>



<style>
    .modal.right.modal-dialog{
        rop:0;
        right:0;
        margin-right:19vh;
    }

    .modal.fade:out(.in).right.modal-dialog{
        -webkit-transform: translated(25%, 0, 0);
        transform: translated(25%, ,0,0)
    }
</style>
@endsection