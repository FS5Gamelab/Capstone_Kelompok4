<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Order</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Navbar Start -->
    @include('customer/navbar')
    <!-- Navbar End -->

    <!-- Page Header Start -->
    <div class="page-header container-fluid bg-secondary pt-2 pt-lg-5 pb-2 mb-5">
        <div class="container py-5">
            <div class="row align-items-center py-4">
                <div class="col-md-6 text-center text-md-left">
                    <h1 class="mb-4 mb-md-0 text-white">Buat Order</h1>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="btn text-white" href="{{ url('/') }}">Home</a>
                        <i class="fas fa-angle-right text-white"></i>
                        <a class="btn text-white disabled" href="#">Buat Order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <div id="order_cs" class="main-content">
        <div class="container">
            <div class="row mt-2">
                <div class="col">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h2>Dry Clean</h2>
                            <a href="{{ route('orders.index') }}" class="btn btn-primary btn-sm">Kembali</a>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('orders.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama">Nama Pelanggan</label>
                                            <input type="text" name="nama_pel_cs" class="form-control" placeholder="Nama lengkap" autocomplete="off" id="nama">
                                        </div>

                                        <div class="form-group">
                                            <label for="no-telp">Nomor Telepon</label>
                                            <input type="text" name="no_telp_cs" class="form-control" placeholder="Nomor Telepon" autocomplete="off" id="no-telp">
                                        </div>

                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <textarea name="alamat_cs" class="form-control" rows="4" id="alamat"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pilih_paket">Pilih Paket</label>
                                            <select name="jenis_paket_cs" class="form-control" id="pilih_paket">
                                                <option>-- Pilih Jenis Paket --</option>
                                                @foreach ($data_cs as $cs)
                                                    <option value="{{ $cs->id }}">{{ $cs->nama_cs }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="kuantitas">Jumlah Order Per/Pcs</label>
                                            <input type="number" name="jml_pcs" class="form-control" placeholder="Jumlah Order (Pcs)" autocomplete="off" id="kuantitas">
                                        </div>

                                        <div class="form-group">
                                            <label for="tgl_order_msk">Tanggal Order Masuk</label>
                                            <input type="date" name="tgl_masuk_cs" class="form-control" autocomplete="off" id="tgl_order_msk">
                                        </div>

                                        <div class="form-group">
                                            <label for="ket">Keterangan</label>
                                            <textarea name="keterangan_cs" class="form-control" rows="4" id="ket"></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-primary btn-sm">Pesan</button>
                                    <button type="reset" class="btn btn-secondary btn-sm">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Start -->
    @include('customer/footer')
    <!-- Footer End -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
