@extends('customer.order')

@section('content')
<!-- Page Header Start -->
<br> <br> <br>
<div class="page-header container-fluid bg-secondary pt-2 pt-lg-5 pb-2 mb-5">
    <div class="container py-5">
        <div class="row align-items-center py-4">
            <div class="col-md-6 text-center text-md-left">
                <h1 class="mb-4 mb-md-0 text-white">Orders</h1>
            </div>
            <div class="col-md-6 text-center text-md-right">
                <div class="d-inline-flex align-items-center">
                    <a class="btn text-white" href="">Home</a>
                    <i class="fas fa-angle-right text-white"></i>
                    <a class="btn text-white disabled" href="">Orders</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Header Start -->

<div class="content-wrapper">
    <div class="content">
        <div class="container mt-5">
            <div class="card">
                <div class="card-header text-left">        
                    <a href="{{ route('createOrder') }}" class="btn btn-info" role="button">Add Order</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="data-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Order Number</th>
                                    <th>Category</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Order Date</th>
                                    <th>Delivery Date</th>
                                    <th>Quantity (Kg)</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $order->order_number }}</td>
                                        <td>{{ $order->category->type_laundry }}</td> <!-- Memperbaiki ID categories -->
                                        <td>{{ $order->phone_number }}</td>
                                        <td>{{ $order->address }}</td>
                                        <td>{{ $order->order_date->format('d-m-Y') }}</td>
                                        <td>{{ $order->delivery_date ? $order->delivery_date->format('d-m-Y') : 'Not set' }}</td>
                                        <td>{{ $order->quantity_kg }}</td> <!-- Menambahkan ID quantity_kg -->
                                        <td>Rp {{ number_format($order->total_price, 0, ',', '.') }},00</td>
                                        <td>{{ $order->status }}</td>
                                        <td>
                                        <div class="btn-group" role="group">
                                            <a href="" class="btn btn-warning btn-sm" role="button"><i class="fas fa-edit"></i></a>
                                        </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function updateTotal() {
        var selectedQuantity = document.getElementById('quantity_kg').value;
        var selectedPrice = document.getElementById('categories').options[document.getElementById('categories').selectedIndex].getAttribute('price'); // Memperbaiki ID categories
        var totalHarga = selectedQuantity * selectedPrice;
        document.getElementById('total_price').value = totalHarga || 0;
    }
</script>
@endpush
