@extends('admin.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Employee</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('listEmployees')}}">List Employee</a></li>
                        <li class="breadcrumb-item active">Add Employee</li>
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
                            <form action="{{ route('storeEmployees') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="form-group">
                                    <label class="font-weight-bold">Profile Picture</label>
                                    <input type="file" class="form-control @error('profile_picture') is-invalid @enderror" name="profile_picture">
                                </div>
                                <div class="form-group">
                                    <label for="employees_name">Employee Name</label>
                                    <input type="text" name="employees_name" id="employees_name" class="form-control" required placeholder="Enter employee name">
                                </div>
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select name="gender" id="gender" class="form-control" required>
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Employee Phone Number</label>
                                    <input type="text" name="phone_number" id="phone_number" class="form-control" required placeholder="Enter employee phone number">
                                </div>
                                <div class="form-group">
                                    <label for="address">Employee Address</label>
                                    <input type="text" name="address" id="address" class="form-control" required placeholder="Enter employee address">
                                </div>
                                <div class="text-right">
                                    <a href="{{ route('listEmployees') }}" class="btn btn-outline-secondary mr-2" role="button">Cancel</a>
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
