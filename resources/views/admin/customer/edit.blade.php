@extends('admin.master')
@section('content') <br> 
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Customer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('listCustomer')}}">List Customer</a></li>
                        <li class="breadcrumb-item active">Edit Customer</li>
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
                            <form action="{{ route('updateCustomer', ['id' => $customer->id]) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="customer_name">Customer Name</label>
                                    <input type="text" name="customer_name" id="customer_name" class="form-control" required="required" value="{{ $customer->customer_name }}" placeholder="Enter the customer name">
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="number" name="phone_number" id="phone_number" class="form-control" required="required" value="{{ $customer->phone_number }}" placeholder="Enter the customer phone number">
                                </div>
                                <div class="form-group">
                                    <label for="address">Customer Address</label>
                                    <input type="text" name="address" id="address" class="form-control" required="required" value="{{ $customer->address }}" placeholder="Enter the customer address">
                                </div>
                                <div class="text-right">
                                    <a href="{{ route('listCustomer') }}" class="btn btn-outline-secondary mr-2" role="button">Cancel</a>
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
