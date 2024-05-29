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
                            <form action="{{ route('updateEmployees', ['id' => $employees->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label class="font-weight-bold">Profile Picture</label>
                                    <input type="file" class="form-control" name="profile_picture">
                                    @if ($employees->profile_picture)
                                        <div class="mt-2">
                                            <img src="{{ Storage::url('artikels/'.$employees->profile_picture) }}" alt="Profile Picture" width="150">
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="employees_name">Employee Name</label>
                                    <input type="text" name="employees_name" id="employees_name" class="form-control" required value="{{ $employees->employees_name }}" placeholder="Enter employee name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" required value="{{ $employees->user->email }}" placeholder="Enter employee email">
                                </div>
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select name="gender" id="gender" class="form-control" required>
                                        <option value="">Select Gender</option>
                                        <option value="Male" {{ $employees->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ $employees->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Employee Phone Number</label>
                                    <input type="text" name="phone_number" id="phone_number" class="form-control" required value="{{ $employees->phone_number }}" placeholder="Enter employee phone number">
                                </div>
                                <div class="form-group">
                                    <label for="address">Employee Address</label>
                                    <input type="text" name="address" id="address" class="form-control" required value="{{ $employees->address }}" placeholder="Enter employee address">
                                </div>
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select name="role" id="role" class="form-control" required>
                                        <option value="">Select Role</option>
                                        <option value="Employee" {{ $employees->user->role == 'Employee' ? 'selected' : '' }}>Employee</option>
                                        <option value="Super-admin" {{ $employees->user->role == 'Super-admin' ? 'selected' : '' }}>Super-admin</option>
                                    </select>
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
