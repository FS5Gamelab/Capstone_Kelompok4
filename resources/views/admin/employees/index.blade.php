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
        /* New style for table cells */
        .table-responsive tbody td {
            vertical-align: middle;
        }
        .table-responsive img {
            width: 100px; /* Memperbesar lebar gambar */
            height: auto;
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
                title: 'Confirm Delete',
                text: 'Are You Sure You Want to Delete This Data?',
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
                    <h1 class="m-0">LIST EMPLOYEE</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container mt-5">
            <div class="card">
                <div class="card-header text-left">
                    <a href="{{ route('createEmployees') }}" class="btn btn-info" role="button"><i class="fas fa-plus"></i> Employee</a>
                    <a class="btn btn-dark" role="button" href="/admin"><i class="fas fa-arrow-left"></i> Back</a>
                    <a href="{{ route('trashEmployees') }}" class="btn btn-danger" role="button"><i class="fas fa-trash"></i> Trash</a>
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
                                @foreach ($employees as $employee)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>
                                        @if($employee->profile_picture)
                                            <img src="{{ Storage::url('artikels/'.$employee->profile_picture) }}" alt="profile picture">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>{{ $employee->employees_name }}</td>
                                    <td>{{ $employee->user ? $employee->user->email : 'No Email' }}</td> <!-- Tambahkan pemeriksaan relasi user -->
                                    <td>{{ $employee->gender }}</td>
                                    <td>{{ $employee->phone_number }}</td>
                                    <td>{{ $employee->address }}</td>
                                    <td>{{ $employee->user ? $employee->user->role : 'No Role' }}</td> <!-- Tambahkan pemeriksaan relasi user -->
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('editEmployees', ['id' => $employee->id]) }}" class="btn btn-warning btn-sm" role="button"><i class="fas fa-edit"></i></a>
                                            <form id="delete-form-{{ $employee->id }}" action="{{ route('deleteEmployees', ['id' => $employee->id]) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button onclick="confirmDelete({{ $employee->id }})" class="btn btn-danger btn-sm" role="button"><i class="fas fa-trash-alt"></i></button>
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
