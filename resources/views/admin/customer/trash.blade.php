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
        function confirmPermanentDelete(id) {
            swal({
                title: 'Confirm Permanent Delete',
                text: 'Are You Sure You Want to Delete This Data Permanently?',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    document.getElementById('delete-form-' + id).submit();
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
                    <h1 class="m-0">Trashed Customers</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container mt-5">
            <div class="card">
                <div class="card-header text-left">
                    <a href="{{ route('listCustomer') }}" class="btn btn-dark" role="button">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
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
                            @foreach ($trashedCustomers as $trashedCustomer)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $trashedCustomer->customer_name }}</td>
                                <td>{{ $trashedCustomer->phone_number }}</td>
                                <td>{{ $trashedCustomer->address }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <form action="{{ route('restoreCustomer', ['id' => $trashedCustomer->id]) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-trash-restore"></i> Restore</button>
                                        </form>
                                        <form id="delete-form-{{ $trashedCustomer->id }}" action="{{ route('forceDeleteCustomer', ['id' => $trashedCustomer->id]) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <button onclick="confirmPermanentDelete({{ $trashedCustomer->id }})" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete Permanently</button>
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
