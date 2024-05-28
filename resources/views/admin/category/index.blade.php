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
                    <h1 class="m-0">LIST CATEGORY</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container mt-5">
            <div class="card">
                <div class="card-header text-left">        
                    <a href="{{ route('createCategory') }}" class="btn btn-info" role="button">Add Category</a>
                    <a class="btn btn-dark" role="button" href="/admin">Back</a>
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
                                <td>Rp.{{ $categories->price }}.000</td>
                                <td>
                                    <a href="{{ route('editCategory', ['id' => $categories->id]) }}" class="btn btn-warning btn-sm" role="button">Edit</a>
                                    <a onclick="confirmDelete(this)" data-url="{{ route('deleteCategory', ['id' => $categories->id]) }}" class="btn btn-danger btn-sm" role="button">Delete</a>
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
