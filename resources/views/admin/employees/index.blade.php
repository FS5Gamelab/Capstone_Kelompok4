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
            font-size: 1.2em; /* Membesarkan ikon */
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
        confirmDelete = function(button) {
            var url = $(button).data('url');
            swal({
                'title': 'Konfirmasi Hapus',
                'text': 'Apakah Kamu Yakin Ingin Menghapus Data Ini?',
                'dangermode': true,
                'buttons': true
            }).then(function(value) {
                if (value) {
                    window.location = url;
                }
            })
        }
    </script>
@endsection
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">LIST EMPLOYEE</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container mt-5">
            <div class="card">
                <div class="card-header text-left">
                    <a href="{{ route('createEmployees') }}" class="btn btn-info" role="button"><i class="fas fa-plus"></i> Add Employee</a>
                    <a class="btn btn-dark" role="button" href="/admin"><i class="fas fa-arrow-left"></i> Back</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="data-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Profile Picture</th>
                                    <th>Employees Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Phone Number</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employeess as $employees)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>
                                        @if($employees->profile_picture)
                                            <img src="{{ Storage::url('artikels/'.$employees->profile_picture) }}" alt="profile picture">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>{{ $employees->employees_name }}</td>
                                    <td>{{ $employees->user->email }}</td>
                                    <td>{{ $employees->gender }}</td>
                                    <td>{{ $employees->phone_number }}</td>
                                    <td>{{ $employees->address }}</td>
                                    <td>{{ $employees->user->role }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('editEmployees', ['id' => $employees->id]) }}" class="btn btn-warning btn-sm" role="button"><i class="fas fa-edit"></i> Edit</a>
                                            <a onclick="confirmDelete(this)" data-url="{{ route('deleteEmployees', ['id' => $employees->id]) }}" class="btn btn-danger btn-sm" role="button"><i class="fas fa-trash-alt"></i> Delete</a>
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
