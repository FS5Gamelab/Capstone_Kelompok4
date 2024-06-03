@extends('admin.master')
@section('addCss')
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
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
        confirmDelete = function(button) {
            var url = $(button).data('url');
            swal({
                title: 'Konfirmasi Hapus',
                text: 'Apakah Kamu Yakin Ingin Menghapus Data Ini?',
                dangerMode: true,
                buttons: true
            }).then(function(value) {
                if (value) {
                    // Menggunakan form untuk mengirimkan metode DELETE
                    var form = document.createElement('form');
                    form.action = url;
                    form.method = 'POST';

                    var inputMethod = document.createElement('input');
                    inputMethod.name = '_method';
                    inputMethod.value = 'DELETE';
                    inputMethod.type = 'hidden';
                    form.appendChild(inputMethod);

                    var inputToken = document.createElement('input');
                    inputToken.name = '_token';
                    inputToken.value = '{{ csrf_token() }}';
                    inputToken.type = 'hidden';
                    form.appendChild(inputToken);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
@endsection
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">LIST CUSTOMER</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container mt-5">
            <div class="card">
                <div class="card-header text-left">
                    <a class="btn btn-dark" role="button" href="/admin"><i class="fas fa-arrow-left"></i> Back</a>
                    <a href="{{ route('trashCustomer') }}" class="btn btn-danger" role="button"><i class="fas fa-trash"></i> Trash</a>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-bordered" id="data-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Customer Name</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $customer->customer_name }}</td>
                                <td>{{ $customer->phone_number }}</td>
                                <td>{{ $customer->address }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('editCustomer', ['id' => $customer->id]) }}" class="btn btn-warning btn-sm" role="button"><i class="fas fa-edit"></i></a>
                                        <a onclick="confirmDelete(this)" data-url="{{ route('deleteCustomer', ['id' => $customer->id]) }}" class="btn btn-danger btn-sm" role="button"><i class="fas fa-trash-alt"></i></a>
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
@endsection
