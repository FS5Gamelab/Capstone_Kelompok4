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
        @media (max-width: 576px) {
            .table thead th,
            .table tbody td {
                font-size: 12px;
                padding: 5px;
            }
            .table .btn-group .btn {
                font-size: 10px;
                padding: 3px 6px;
            }
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
                    <h1 class="m-0">Trashed Employees</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container mt-5">
            <div class="card">
                <div class="card-header text-left">
                    <a href="{{ route('listEmployees') }}" class="btn btn-dark" role="button">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="data-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Profile Picture</th>
                                    <th>Employees Name</th>
                                    <th>Gender</th>
                                    <th>Phone Number</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($trashedEmployees as $trashedEmployee)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>
                                        @if($trashedEmployee->profile_picture)
                                            <img src="{{ Storage::url('artikels/'.$trashedEmployee->profile_picture) }}" alt="profile picture" style="width: 50px">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>{{ $trashedEmployee->employees_name }}</td>
                                    <td>{{ $trashedEmployee->gender }}</td>
                                    <td>{{ $trashedEmployee->phone_number }}</td>
                                    <td>{{ $trashedEmployee->address }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <form action="{{ route('restoreEmployees', ['id' => $trashedEmployee->id]) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-trash-restore"></i> Restore</button>
                                            </form>
                                            <form id="delete-form-{{ $trashedEmployee->id }}" action="{{ route('forceDeleteEmployees', ['id' => $trashedEmployee->id]) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button onclick="confirmPermanentDelete({{ $trashedEmployee->id }})" class="btn btn-danger btn-sm" role="button"><i class="fas fa-trash-alt"></i> Delete Permanently</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div> <!-- .table-responsive -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
