@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('layouts.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Category</div>

                    <div class="card-body">
                        <form action="{{ url('category',$category->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row col-md-12">
                                <div class="col-md-4">
                                    <label>Parent Category Name</label>
                                    <select name="parent_id" id="" class="form-control">
                                        <option value="">Select Parent Category</option>
                                        @foreach($categories as $list)
                                            <option value="{{ $list->id }}" <?= ($category->parent_id == $list->id) ? 'selected' : ''; ?> >{{ $list->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Category Name</label>
                                    <input name="title" class="form-control" value="{{ $category->title }}">
                                </div>
                                <div class="col-md-4">
                                    <label>.</label>
                                    <input type="submit" value="Update" class="form-control">
                                </div>
                            </div>
                        </form>    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection