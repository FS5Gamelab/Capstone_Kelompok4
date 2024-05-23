@extends('admin.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('listCategory')}}">List Category</a></li>
                        <li class="breadcrumb-item active">Add Category</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="card-body">
                        <div class="card">
                            <form action="{{ route('storeCategory') }}" method="post">
                                @csrf
                            
                                <div class="form-group">
                                    <label for="type_laundry">Type of Laundry</label>
                                    <input type="text" name="type_laundry" id="type_laundry" class="form-control" required="required" placeholder="Enter the type of laundry">
                                </div>
                                <div class="form-group">
                                    <label for="working_time">Working Time (Hour)</label>
                                    <input type="number" name="working_time" id="working_time" class="form-control" required="required" placeholder="Enter estimated completion">
                                </div>
                                <div class="form-group">
                                    <label for="price">Price (Rp)</label>
                                    <input type="number" name="price" id="price" class="form-control" required="required" placeholder="Enter price from this category">
                                </div>
                                <div class="text-right">
                                    <a href="{{ route('listCategory') }}" class="btn btn-outline-secondary mr-2" role="button">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
