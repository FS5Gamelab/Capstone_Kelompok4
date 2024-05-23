@extends('admin.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Employee</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('listEmployees')}}">List Employee</a></li>
                        <li class="breadcrumb-item active">Edit Employee</li>
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
                            <form action="{{ route('updateEmployees', ['id' => $employees->id]) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="employees_name">Employee Name</label>
                                    <input type="text" name="employees_name" id="employees_name" class="form-control" required="required" value="{{ $employees->employees_name }}" placeholder="Enter employee name">
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Employee Phone Number</label>
                                    <input type="text" name="phone_number" id="phone_number" class="form-control" required="required" value="{{ $employees->phone_number }}" placeholder="Enter employee phone number">
                                </div>
                                <div class="form-group">
                                    <label for="address">Employee Address</label>
                                    <input type="text" name="address" id="address" class="form-control" required="required" value="{{ $employees->address }}" placeholder="Enter employee address">
                                </div>
                                <div class="text-right">
                                    <a href="{{ route('listEmployees') }}" class="btn btn-outline-secondary mr-2" role="button">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Update</button>
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
