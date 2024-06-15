@extends('customer.order')
@section('addCss')
    <style>
        .btn-custom {
            display: inline-flex;
            align-items: center;
            padding: 0.5em 1em;
            font-size: 1rem;
            border-radius: 0.25em;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .btn-custom i {
            margin-right: 0.5em;
            font-size: 1.2em;
        }

        .btn-custom-primary {
            background-color: #007bff;
            color: white;
            border: none;
        }

        .btn-custom-primary:hover {
            background-color: #0056b3;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-custom-secondary {
            background-color: #6c757d;
            color: white;
            border: none;
        }

        .btn-custom-secondary:hover {
            background-color: #5a6268;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .rating-star {
            color: grey;
            font-size: 2rem;
            cursor: pointer;
        }

        .rating-star.selected,
        .rating-star.hovered {
            color: gold;
        }

        .rating-emoji {
            font-size: 2rem;
            margin-left: 10px;
        }

        .modal-header .close {
            padding: 0.5rem 1rem;
            margin: -1rem -1rem -1rem auto;
            background-color: #f8f9fa;
            border-radius: 0.25rem;
            font-size: 1.5rem;
            color: #6c757d;
            transition: background-color 0.3s, color 0.3s;
        }

        .modal-header .close:hover {
            background-color: #e2e6ea;
            color: #343a40;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const stars = document.querySelectorAll('.rating-star');
            stars.forEach(star => {
                star.addEventListener('click', (e) => {
                    const rating = e.target.dataset.value;
                    document.querySelectorAll('.rating-star').forEach(s => s.classList.remove('selected'));
                    for (let i = 0; i < rating; i++) {
                        stars[i].classList.add('selected');
                    }
                    document.querySelector('#rating-input').value = rating;

                    const emoji = document.querySelector('.rating-emoji');
                    switch (rating) {
                        case '1':
                            emoji.textContent = '😞';
                            break;
                        case '2':
                            emoji.textContent = '😕';
                            break;
                        case '3':
                            emoji.textContent = '😐';
                            break;
                        case '4':
                            emoji.textContent = '🙂';
                            break;
                        case '5':
                            emoji.textContent = '😃';
                            break;
                        default:
                            emoji.textContent = '';
                    }
                });

                star.addEventListener('mouseover', (e) => {
                    const rating = e.target.dataset.value;
                    document.querySelectorAll('.rating-star').forEach(s => s.classList.remove('hovered'));
                    for (let i = 0; i < rating; i++) {
                        stars[i].classList.add('hovered');
                    }
                });

                star.addEventListener('mouseout', (e) => {
                    document.querySelectorAll('.rating-star').forEach(s => s.classList.remove('hovered'));
                });
            });
        });
    </script>
@endsection
@section('content')
<!-- Page Header Start -->
<br><br><br>
<div class="page-header container-fluid bg-secondary pt-2 pt-lg-5 pb-2 mb-5">
    <div class="container py-5">
        <div class="row align-items-center py-4">
            <div class="col-md-6 text-center text-md-left">
                <h1 class="mb-4 mb-md-0 text-white">Detail Orders</h1>
            </div>
            <div class="col-md-6 text-center text-md-right">
                <div class="d-inline-flex align-items-center">
                    <a class="btn text-white" href="#">Home</a>
                    <i class="fas fa-angle-right text-white mx-2"></i>
                    <a class="btn text-white disabled" href="#">Detail Orders</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<div class="content-wrapper">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-center">
                <h2 class="mb-2 mb-md-0">Detail Order</h2>
                <h3 class="text-right"><small>No Order:</small> {{ $order->order_number }}</h3>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <h4>Customer</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>Name</th>
                                <td>{{ $order->customer->customer_name }}</td>
                            </tr>
                            <tr>
                                <th>Phone Number</th>
                                <td>{{ $order->customer->phone_number }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $order->customer->address }}</td>
                            </tr>
                            <tr>
                                <th>Category</th>
                                <td>{{ $order->category->type_laundry }}</td>
                            </tr>
                            <tr>
                                <th>Order Date</th>
                                <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d-m-Y') }}</td>
                            </tr>
                            <tr>
                                <th>Delivery Date</th>
                                <td>{{ $order->delivery_date ? \Carbon\Carbon::parse($order->delivery_date)->format('d-m-Y') : 'Not set' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="mb-4">
                    <h4>Order</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>Quantity (Kg)</th>
                                <th>Price</th>
                                <th>Total Price</th>
                            </tr>
                            <tr>
                                <td>{{ $order->quantity_kg }} Kg</td>
                                <td>Rp {{ number_format($order->category->price, 0, ',', '.') }},00</td>
                                <td>Rp {{ number_format($order->total_price, 0, ',', '.') }},00</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="mb-4">
                    <h4>Payment</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>Payment Type</th>
                                <td>{{ $order->type_pay == 'cod' ? 'Cash on Delivery (COD)' : 'Online' }}</td>
                            </tr>
                            @if ($order->type_pay == 'cod')
                                <tr>
                                    <th>Amount Paid</th>
                                    <td>Rp {{ number_format($order->amount_paid, 0, ',', '.') }},00</td>
                                </tr>
                                <tr>
                                    <th>Change Money</th>
                                    <td>Rp {{ number_format($order->change_money, 0, ',', '.') }},00</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>

                <div class="form-footer text-right">
                    @if ($order->type_pay=='cod') 
                    <a href="{{ route('orderCustomer') }}" class="btn btn-custom btn-custom-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                    @endif
                    @if ($order->status == 'queued' && $order->status != 'already paid' && $order->type_pay == 'online')
                        <button id="pay-button" class="btn btn-custom btn-custom-primary">
                            <i class="fas fa-credit-card"></i> Pay now
                        </button>
                        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
                        <script type="text/javascript">
                            document.getElementById('pay-button').onclick = function(){
                                snap.pay('{{ $snapToken }}', {
                                    onSuccess: function(result){
                                        console.log(result);
                                        window.location.href = '{{ route("payment.success", ["order" => $order->id]) }}';
                                    },
                                    onPending: function(result){
                                        console.log(result);
                                        window.location.href = '{{ route("payment.pending", ["order" => $order->id]) }}';
                                    },
                                    onError: function(result){
                                        console.log(result);
                                        window.location.href = '{{ route("payment.error", ["order" => $order->id]) }}';
                                    }
                                });
                            };
                        </script>
                    @endif
                    @if ($order->status == 'completed')
                        <button id="feedback-button" class="btn btn-custom btn-custom-secondary ml-2" data-toggle="modal" data-target="#feedbackModal">
                            <i class="fas fa-comment"></i> Feedback
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Feedback Modal -->
<div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="feedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('submitFeedback', $order->id) }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="feedbackModalLabel">Submit Feedback</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="rating-input">Rating</label>
                        <div class="rating">
                            <span class="rating-star" data-value="1">&#9733;</span>
                            <span class="rating-star" data-value="2">&#9733;</span>
                            <span class="rating-star" data-value="3">&#9733;</span>
                            <span class="rating-star" data-value="4">&#9733;</span>
                            <span class="rating-star" data-value="5">&#9733;</span>
                            <span class="rating-emoji"></span>
                        </div>
                        <input type="hidden" name="rating" id="rating-input" value="0" required>
                    </div>
                    <div class="form-group">
                        <label for="feedback">Feedback</label>
                        <textarea name="feedback" id="feedback" class="form-control" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-custom btn-custom-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Close
                    </button>
                    <button type="submit" class="btn btn-custom btn-custom-primary">
                        <i class="fas fa-paper-plane"></i> Submit Feedback
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection