@extends('admin.master')

@section('content') <br> <br>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">DASHBOARD</h1>
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
                <p>Total Orders</p>
                
              </div>
              <div class="icon">
                <i class="fas fa-shopping-cart" style="color: white"></i>
              </div>
              <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <p>Total Customer</p>
                <h1>{{ $customer }}</h1>
              </div>
              <div class="icon">
                <i class="fas fa-users" style="color: white"></i>
              </div>
              <a href="{{ route('listCustomer') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <p>Total Employee</p>
                <h1>{{ $employees }}</h1>
              </div>
              <div class="icon">
                <i class="fas fa-book-open" style="color: white"></i>
              </div>
              <a href="{{ route('listEmployees') }}" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
              <div class="inner">
                <p>Total Category</p>
                <h1>{{ $categories }}</h1>
              </div>
              <div class="icon">
                <i class="fas fa-th" style="color: white"></i>
              </div>
              <a href="{{ route('listCategory') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <!-- ./col -->
          
        </div>

        <!-- About Start -->
        <div class="container-fluid py-5">
          <div class="container">
              <div class="row align-items-center">
                  <div class="col-lg-12">
                      <div class="card mb-4 p-5">
                          <div class="row no-gutters">
                              <div class="col-lg-4">
                                  <img class="img-fluid" src="img/about.jpg" alt="" style="max-width: 100%; height: auto;">
                              </div>
                              <div class="col-lg-8">
                                  <div class="card-body">
                                      <h6 class="text-secondary text-uppercase font-weight-medium mb-3">Learn About Us</h6>
                                      <h1 class="mb-4">We Are Quality Laundry Provider In Your City</h1>
                                      <h5 class="font-weight-medium font-italic mb-4">Online Laundry Service with Real-Time Tracking</h5>
                                      <p class="mb-2">Web-based online laundry services with real-time tracking provide a convenient and transparent solution for managing laundry. These services allow customers to schedule pickups, track the status of their laundry, and receive notifications, all through a web platform.</p>
                                      <div class="row">
                                          <div class="col-sm-6 pt-3">
                                              <div class="d-flex align-items-center">
                                                  <i class="fa fa-check text-primary mr-2"></i>
                                                  <p class="text-secondary font-weight-medium m-0">Quality Laundry Service</p>
                                              </div>
                                          </div>
                                          <div class="col-sm-6 pt-3">
                                              <div class="d-flex align-items-center">
                                                  <i class="fa fa-check text-primary mr-2"></i>
                                                  <p class="text-secondary font-weight-medium m-0">Express Fast Delivery</p>
                                              </div>
                                          </div>
                                          <div class="col-sm-6 pt-3">
                                              <div class="d-flex align-items-center">
                                                  <i class="fa fa-check text-primary mr-2"></i>
                                                  <p class="text-secondary font-weight-medium m-0">Highly Professional Staff</p>
                                              </div>
                                          </div>
                                          <div class="col-sm-6 pt-3">
                                              <div class="d-flex align-items-center">
                                                  <i class="fa fa-check text-primary mr-2"></i>
                                                  <p class="text-secondary font-weight-medium m-0">100% Satisfaction Guarantee</p>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      
        <!-- About End -->
       
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection