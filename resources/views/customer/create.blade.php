@extends('customer.order')
@section('addCss')
    <style>
        .btn-custom {
            display: inline-flex;
            align-items: center;
            padding: 0.5em 1em;
            font-size: 1rem;
            border-radius: 0.25em;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .btn-custom i {
            margin-right: 0.5em;
            font-size: 1.2em;
        }

        .btn-custom-primary {
            background-color: #007bff;
            color: white;
            border: none;
        }

        .btn-custom-primary:hover {
            background-color: #0056b3;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-custom-secondary {
            background-color: #6c757d;
            color: white;
            border: none;
        }

        .btn-custom-secondary:hover {
            background-color: #5a6268;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
@endsection
@section('content')
    <!-- Page Header Start -->
    <br> <Br> </Br>
    <div class="page-header container-fluid bg-secondary pt-2 pt-lg-5 pb-2 mb-5">
        <div class="container py-5">
            <div class="row align-items-center py-4">
                <div class="col-md-6 text-center text-md-left">
                    <h1 class="mb-4 mb-md-0 text-white">Create Order</h1>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="btn text-white" href="{{ url('/') }}">Home</a>
                        <i class="fas fa-angle-right text-white"></i>
                        <a class="btn text-white disabled" href="#">Create Order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="main-content">
        <div class="container">
            <div class="row mt-2">
                <div class="col">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <a href="{{ route('orderCustomer') }}" class="btn btn-custom btn-custom-secondary btn-sm"> <!-- Menggunakan gaya tombol custom dan secondary -->
                                <i class="fas fa-arrow-left"></i> Back 
                            </a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('storeOrder') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="category_id">Select Category</label>
                                            <select name="category_id" class="form-control" id="category_id" required>
                                                <option value="">-- Select Category --</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->type_laundry }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone_number">Phone number</label>
                                            <input type="text" name="phone_number" class="form-control" placeholder="phone_number" autocomplete="off" id="phone_number">
                                        </div>

                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <textarea name="address" class="form-control" rows="4" id="address"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="quantity_kg">Quantity (Kg)</label>
                                            <input type="number" id="quantity_kg" name="quantity_kg" class="form-control" placeholder="Quantity in Kg" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="order_date">Order Date</label>
                                            <input type="date" id="order_date" name="order_date" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="type_pay">Payment Type</label>
                                            <select name="type_pay" class="form-control" id="type_pay" required>
                                                <option value="">-- Select Payment Type --</option>
                                                <option value="cod">Cash on Delivery (COD)</option>
                                                <option value="online">Online</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-custom btn-custom-primary">
                                        <i class="fas fa-plus"></i> Create
                                    </button>
                                    <button type="reset" class="btn btn-custom btn-custom-secondary">
                                        <i class="fas fas fa-undo"></i> Reset
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection