@extends('customer.order')
@section('addCss')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
<br><br><br>
<div class="page-header container-fluid bg-secondary pt-2 pt-lg-5 pb-2 mb-5">
    <div class="container py-5">
        <div class="row align-items-center py-4">
            <div class="col-md-6 text-center text-md-left">
                <h1 class="mb-4 mb-md-0 text-white">Detail Orders</h1>
            </div>
            <div class="col-md-6 text-center text-md-right">
                <div class="d-inline-flex align-items-center">
                    <a class="btn text-white" href="#">Home</a>
                    <i class="fas fa-angle-right text-white mx-2"></i>
                    <a class="btn text-white disabled" href="#">Detail Orders</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<div class="content-wrapper">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-center">
                <h2 class="mb-2 mb-md-0">Detail Order</h2>
                <h3 class="text-right"><small>No Order:</small> {{ $order->order_number }}</h3>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <h4>Customer</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>Name</th>
                                <td>{{ $order->customer->customer_name }}</td>
                            </tr>
                            <tr>
                                <th>Phone Number</th>
                                <td>{{ $order->customer->phone_number }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $order->customer->address }}</td>
                            </tr>
                            <tr>
                                <th>Order Date</th>
                                <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d-m-Y') }}</td>
                            </tr>
                            <tr>
                                <th>Delivery Date</th>
                                <td>{{ $order->delivery_date ? \Carbon\Carbon::parse($order->delivery_date)->format('d-m-Y') : 'Not set' }}</td>
                            </tr>
                            <tr>
                                <th>Category</th>
                                <td>{{ $order->category->type_laundry }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="mb-4">
                    <h4>Order</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>Quantity (Kg)</th>
                                <th>Price</th>
                                <th>Total Price</th>
                            </tr>
                            <tr>
                                <td>{{ $order->quantity_kg }} Kg</td>
                                <td>Rp {{ number_format($order->category->price, 0, ',', '.') }},00</td>
                                <td>Rp {{ number_format($order->total_price, 0, ',', '.') }},00</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="form-footer text-right">
                    @if ($order->status == 'queued' && $order->status != 'already paid')
                        <button id="pay-button" class="btn btn-custom btn-custom-primary"> <!-- Menggunakan gaya tombol custom -->
                            <i class="fas fa-credit-card"></i> Pay now <!-- Menggunakan ikon credit card -->
                        </button>
                    @endif
                    @if ($order->status == 'completed')
                        <button id="feedback-button" class="btn btn-custom btn-custom-secondary ml-2"> <!-- Menggunakan gaya tombol custom dan secondary -->
                            <i class="fas fa-comment"></i> Feedback <!-- Menggunakan ikon komentar -->
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection