@extends('admin.master')

@section('addCss')
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .table-responsive img {
            width: 50px;
            height: auto;
        }
        .table-responsive .btn-group {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .table-responsive .btn {
            margin: 2px;
        }
        .table-responsive .btn i {
            font-size: 1.2em;
        }
    </style>
@endsection

@section('addJavascript')
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(function() {
            $("#data-table").DataTable();
        })
    </script>
    <script>
        function confirmDelete(id) {
            swal({
                title: 'Konfirmasi Hapus',
                text: 'Apakah Kamu Yakin Ingin Menghapus Data Ini?',
                dangerMode: true,
                buttons: true
            }).then(function(value) {
                if (value) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endsection

@section('content') <br><br>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">LIST ORDERS</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container mt-5">
            <div class="card">
                <div class="card-header text-left">
                    <a class="btn btn-dark" role="button" href="/admin"><i class="fas fa-arrow-left"></i> Back</a>
                    <a href="" class="btn btn-danger" role="button"><i class="fas fa-trash"></i> Trash</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="data-table">
                        <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Order Number</th>
                                    <th>Name</th>
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
                                        <td>{{ $order->customer->customer_name }}</td>
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
