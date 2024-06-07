@extends('customer.order')

@section('content')
<!-- Page Header Start -->
<br> <br> <br>
<div class="page-header container-fluid bg-secondary pt-2 pt-lg-5 pb-2 mb-5">
    <div class="container py-5">
        <div class="row align-items-center py-4">
            <div class="col-md-6 text-center text-md-left">
                <h1 class="mb-4 mb-md-0 text-white">Detail Orders</h1>
            </div>
            <div class="col-md-6 text-center text-md-right">
                <div class="d-inline-flex align-items-center">
                    <a class="btn text-white" href="">Home</a>
                    <i class="fas fa-angle-right text-white"></i>
                    <a class="btn text-white disabled" href="">Detail Orders</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<div class="content-wrapper">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2>Detail Order</h2>
                <h3 class="text-right"><small>No Order:</small> {{ $order->order_number }}</h3>
            </div>
            <div class="card-body">
                <h4>Customer</h4>
                <table class="table table-bordered">
                    <tr>
                        <th>Nama</th>
                        <td>{{ $order->customer->customer_name }}</td>
                    </tr>
                    <tr>
                        <th>Nomor Telepon</th>
                        <td>{{ $order->customer->phone_number }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $order->customer->address }}</td>
                    </tr>
                    <tr>
                        <th>Order Masuk</th>
                        <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <th>Diambil Pada</th>
                        <td>{{ $order->delivery_date ? \Carbon\Carbon::parse($order->delivery_date)->format('d-m-Y') : 'Not set' }}</td>
                    </tr>
                    <tr>
                        <th>Durasi Kerja</th>
                        <td>{{ $order->duration }} Hari</td>
                    </tr>
                    <tr>
                        <th>Jenis Paket</th>
                        <td>{{ $order->category->type_laundry }}</td>
                    </tr>
                </table>

                <h4>Order</h4>
                <table class="table table-bordered">
                    <tr>
                        <th>Berat (Kg)</th>
                        <th>Harga Per-Kg</th>
                        <th>Total Bayar</th>
                    </tr>
                    <tr>
                        <td>{{ $order->quantity_kg }} Kg</td>
                        <td>Rp. {{ number_format($order->category->price, 0, ',', '.'),00 }}</td>
                        <td>Rp. {{ number_format($order->total_price, 0, ',', '.'),00 }}</td>
                    </tr>
                </table>

                <div class="details">
                    <h4 class="mb-3">Keterangan:</h4>
                    <p>{{ $order->description }}</p>
                </div>

                <div class="form-footer">
                    <a href="#" class="btn btn-primary">Bayar Sekarang</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
