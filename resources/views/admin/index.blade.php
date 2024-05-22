@extends('admin.master')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3></h3>
                <p>Order</p>
              </div>
              <div class="icon">
                <i class="fas fa-th" style="color: white"></i>
              </div>
              <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3></h3>
                <p>Customer</p>
              </div>
              <div class="icon">
                <i class="fas fa-book-open" style="color: white"></i>
              </div>
              <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3></h3>
                <p>Employee</p>
              </div>
              <div class="icon">
                <i class="fas fa-users" style="color: white"></i>
              </div>
              <a href="" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
              <div class="inner">
                <h3></h3>
                <p>Category</p>
              </div>
              <div class="icon">
                <i class="fas fa-th" style="color: white"></i>
              </div>
              <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <!-- ./col -->
          
        </div>

        <div class="row mt-5">
          <div class="col-lg-6">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">Data Orderan</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title"></h6>

                <p class="card-text">Halaman ini berisi data Orderan pelanggan, disini kita bisa menambah,mengedit dan menghapus orderan dengan mudah.</p>
                <a href="" class="btn btn-primary">Ke Data Orderan</a>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-6">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">Daftar Category</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title"></h6>

                <p class="card-text">Halaman ini berisi daftar category yang ada pada webiste ini. Disini kita bisa menambah,mengedit,dan menghapus data category dengan mudah.</p>
                <a href="" class="btn btn-primary">Ke Daftar Category</a>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
       
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection