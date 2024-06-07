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
                'title': 'Confirm Delete',
                'text': 'Are You Sure You Want to Delete This Data?',
                'dangerMode': true,
                'buttons': true
            }).then(function(value) {
                if (value) {
                    window.location = url;
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
                    <h1 class="m-0">LIST CATEGORY</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container mt-5">
            <div class="card">
                <div class="card-header text-left">        
                    <a href="{{ route('createCategory') }}" class="btn btn-info" role="button"><i class="fas fa-plus"></i> Category</a>
                    <a class="btn btn-dark" role="button" href="/admin"><i class="fas fa-arrow-left"></i> Back</a>
                    <a href="{{ route('trashCategory') }}" class="btn btn-danger" role="button"><i class="fas fa-trash"></i> Trash</a>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-bordered" id="data-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Type of Laundry</th>
                                <th>Working Time (Day)</th>
                                <th>Price (Rp)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categoriess as $categories)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $categories->type_laundry }}</td>
                                <td>{{ $categories->working_time }}</td>
                                <td>Rp {{ number_format($categories->price, 0, ',', '.') }},00</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('editCategory', ['id' => $categories->id]) }}" class="btn btn-warning btn-sm" role="button"><i class="fas fa-edit"></i></a>
                                        <a onclick="confirmDelete(this)" data-url="{{ route('deleteCategory', ['id' => $categories->id]) }}" class="btn btn-danger btn-sm" role="button"><i class="fas fa-trash-alt"></i></a>
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
