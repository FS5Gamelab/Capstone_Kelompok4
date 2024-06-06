@extends('employee.order')

@section('addCss')
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('addJavascript')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#data-table').DataTable();
        });

        function confirmDelete(button) {
            var url = $(button).data('url');
            swal({
                title: 'Confirm Delete',
                text: 'Are You Sure You Want to Delete This Data?',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((value) => {
                if (value) {
                    window.location = url;
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
<!-- Page Header Start -->

<div class="content-wrapper">
    <div class="content">
        <div class="container mt-5">
            <div class="card">
                <div class="card-header text-left">
                    <a class="btn btn-dark" role="button" href="/admin">Back</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="data-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Number Order</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Order Date</th>
                                    <th>Delivery Date</th>
                                    <th>Quantity (Kg)</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>123</td>
                                    <td>John Doe</td>
                                    <td>2024-06-05</td>
                                    <td>Completed</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="#" class="btn btn-primary btn-sm" role="button">View</a>
                                            <a href="#" class="btn btn-danger btn-sm" role="button" onclick="confirmDelete(this)" data-url="/delete/123">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
