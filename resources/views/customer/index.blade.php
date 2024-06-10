@extends('customer.order')
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
        /* Custom styles to widen the card */
        .card {
            width: 100%;
        }
        .container-fluid {
            max-width: 100%;
        }
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

@section('addJavascript')
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(function() {
            $("#data-table").DataTable();
        });
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
<!-- Page Header End -->

<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid mt-5"> <!-- Changed to container-fluid -->
            <div class="card">
                <div class="card-header text-left">
                    <a href="{{ route('createOrder') }}" class="btn btn-custom btn-custom-primary" role="button"> <!-- Menggunakan gaya tombol custom dan primary -->
                        <i class="fas fa-plus"></i> Add Order
                    </a>
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
                                        <td>{{ $order->category->type_laundry }}</td>
                                        <td>{{ $order->phone_number }}</td>
                                        <td>{{ $order->address }}</td>
                                        <td>{{ $order->order_date->format('d-m-Y') }}</td>
                                        <td>{{ $order->delivery_date ? $order->delivery_date->format('d-m-Y') : 'Not set' }}</td>
                                        <td>{{ $order->quantity_kg }}</td>
                                        <td>Rp {{ number_format($order->total_price, 0, ',', '.') }},00</td>
                                        <td>
                                            <button type="button" class="btn btn-{{ $order->status == 'queued' ? 'warning' : ($order->status == 'being picked up' ? 'info' : ($order->status == 'completed' ? 'success' : 'primary')) }} btn-sm" disabled>
                                                <i class="fas fa-{{ $order->status == 'queued' ? 'clock' : ($order->status == 'being picked up' ? 'truck-loading' : ($order->status == 'completed' ? 'check-circle' : 'check')) }}"></i>
                                                    {{ $order->status }}
                                            </button>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('detailOrder', ['id' => $order->id]) }}" class="btn btn-custom btn-custom-primary btn-sm" role="button">
                                                    <i class="fas fa-info-circle"></i> Detail
                                                </a>
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
        var selectedPrice = document.getElementById('categories').options[document.getElementById('categories').selectedIndex].getAttribute('price');
        var totalHarga = selectedQuantity * selectedPrice;
        document.getElementById('total_price').value = totalHarga || 0;
    }
</script>
@endpush
