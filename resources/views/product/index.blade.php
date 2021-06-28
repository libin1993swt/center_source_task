@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('layouts.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Category</div>

                    <div class="card-body">
                        <form action="{{ url('product/create') }}" method="post">
                            @csrf
                            <div class="row col-md-12">
                                <div class="col-md-4">
                                    <label> Category </label>
                                    <select name="category_id" id="" class="form-control" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Product Name</label>
                                    <input name="title" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label>.</label>
                                    <input type="submit" value="Save" class="form-control">
                                </div>
                            </div>
                        </form>    
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <tr>
                                        <th></th>
                                        <th>Product</th>
                                        <th>Product Category</th>
                                        <th>Product URL</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach($products as $key => $product)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $product->title }}</td>
                                        
                                            <td> {{ $product->category->title }}</td>
                                       
                                        <td>{{ url('/').$product->url }} </td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection