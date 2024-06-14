<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Track Laundry</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;800&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <style>
        * {
            margin: 0px;
            padding: 0px;
            font-family: poppins;
            box-sizing: border-box;
        }
        a {
            text-decoration: none;
        }
        #testimonials {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: 100%;
        }
        .testimonial-heading {
            letter-spacing: 1px;
            margin: 30px 0px;
            padding: 10px 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .testimonial-heading h1 {
            font-size: 2.2rem;
            font-weight: 500;
            background-color: #202020;
            color: #ffffff;
            padding: 10px 20px;
        }
        .testimonial-heading span {
            font-size: 1.3rem;
            color: #252525;
            margin-bottom: 10px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .testimonial-box-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            width: 100%;
        }
        .testimonial-box {
            width: 500px;
            box-shadow: 2px 2px 30px rgba(0,0,0,0.1);
            background-color: #ffffff;
            padding: 20px;
            margin: 15px;
            cursor: pointer;
        }
        .profile-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 10px;
        }
        .profile-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }
        .profile {
            display: flex;
            align-items: center;
        }
        .name-user {
            display: flex;
            flex-direction: column;
        }
        .name-user strong {
            color: #3d3d3d;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
        }
        .name-user span {
            color: #979797;
            font-size: 0.8rem;
        }
        .reviews {
            color: #f9d71c;
        }
        .box-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .client-comment p {
            font-size: 0.9rem;
            color: #4b4b4b;
        }
        .testimonial-box:hover {
            transform: translateY(-10px);
            transition: all ease 0.3s;
        }
        @media (max-width: 1060px) {
            .testimonial-box {
                width: 45%;
                padding: 10px;
            }
        }
        @media (max-width: 790px) {
            .testimonial-box {
                width: 100%;
            }
            .testimonial-heading h1 {
                font-size: 1.4rem;
            }
        }
        @media (max-width: 340px) {
            .box-top {
                flex-wrap: wrap;
                margin-bottom: 10px;
            }
            .reviews {
                margin-top: 10px;
            }
        }
        ::selection {
            color: #ffffff;
            background-color: #252525;
        }
    </style>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-primary py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6 ml-auto text-center text-md-right">
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    @include('customer/navbar')
    <!-- Navbar End -->

    <br><br>
    <!-- Page Header Start -->
    <div class="page-header container-fluid bg-secondary pt-2 pt-lg-5 pb-2 mb-5">
        <div class="container py-5">
            <div class="row align-items-center py-4">
                <div class="col-md-6 text-center text-md-left">
                    <h1 class="mb-4 mb-md-0 text-white">Feedbacks</h1>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="btn text-white" href="{{ route('pages') }}">Home</a>
                        <i class="fas fa-angle-right text-white"></i>
                        <a class="btn text-white disabled" href="">Feedbacks</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Testimonials Start -->
    <section id="testimonials">
        <!-- Heading -->
        <div class="testimonial-heading">
            <span>Feedbacks</span>
            <h1>Customer Say</h1>
        </div>
        <!-- Testimonials Box Container -->
        <div class="testimonial-box-container">
            @foreach($feedbacks as $feedback)
                <div class="testimonial-box">
                    <div class="box-top">
                        <div class="profile">
                            <div class="name-user">
                                <strong>{{ $feedback->customer->customer_name }}</strong>
                            </div>
                        </div>
                        <div class="reviews">
                            @for($i = 0; $i < 5; $i++)
                                @if($i < $feedback->rating)
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
                    </div>
                    <div class="client-comment">
                        <p>{{ $feedback->feedback }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <!-- Testimonials End -->

    <!-- Footer Start -->
    @include('customer/footer')
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

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
