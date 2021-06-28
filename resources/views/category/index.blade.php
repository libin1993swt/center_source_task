@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('layouts.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Category</div>

                    <div class="card-body">
                        <form action="{{ url('category/create') }}" method="post">
                            @csrf
                            <div class="row col-md-12">
                                <div class="col-md-4">
                                    <label>Parent Category Name</label>
                                    <select name="parent_id" id="" class="form-control">
                                        <option value="">Select Parent Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Category Name</label>
                                    <input name="title" class="form-control">
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
                                        <th>Category</th>
                                        <th>Parent Category</th>
                                        <th>Category URL</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach($categories as $key => $category)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $category->title }}</td>
                                        @if(!empty($category->parent) && count($category->parent) > 0)
                                            @foreach($category->parent as $parent)
                                                <td>{{ $parent->title }}</td>
                                            @endforeach
                                        @else
                                            <td>-</td>
                                        @endif
                                        <td>{{ url('/').$category->url }} </td>
                                        <td>
                                            <a href="{{ url('category/'.$category->id.'/edit') }}" class="btn btn-primary">Edit</a>
                                        </td>
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