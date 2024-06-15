@extends('employee.order')

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
    </style>
@endsection

@section('content')
<!-- Page Header Start -->
<div class="page-header container-fluid bg-secondary pt-2 pt-lg-5 pb-2 mb-5">
    <div class="container py-5">
        <div class="row align-items-center py-4">
            <div class="col-md-6 text-center text-md-left">
                <h1 class="mb-4 mb-md-0 text-white">Edit Orders</h1>
            </div>
            <div class="col-md-6 text-center text-md-right">
                <div class="d-inline-flex align-items-center">
                    <a class="btn text-white" href="">Home</a>
                    <i class="fas fa-angle-right text-white"></i>
                    <a class="btn text-white disabled" href="">Edit Orders</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<div class="container">
    <h2>Edit Order</h2>
    <form action="{{ route('updateOrder', $order->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="status">Order Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="being picked up" {{ $order->status == 'being picked up' ? 'selected' : '' }}>Being Picked Up</option>
                <option value="being washed" {{ $order->status == 'being washed' ? 'selected' : '' }}>Being Washed</option>
                <option value="being dried" {{ $order->status == 'being dried' ? 'selected' : '' }}>Being Dried</option>
                <option value="being ironed" {{ $order->status == 'being ironed' ? 'selected' : '' }}>Being Ironed</option>
                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>
        <div class="form-group" id="delivery-date-group" style="{{ $order->status == 'delivered' ? '' : 'display:none;' }}">
            <label for="delivery_date">Delivery Date</label>
            <input type="date" name="delivery_date" id="delivery_date" class="form-control" value="{{ $order->delivery_date ? \Carbon\Carbon::parse($order->delivery_date)->format('Y-m-d') : '' }}">
        </div>
        <button type="submit" class="btn btn-custom btn-custom-primary">
            <i class="fas fa-save"></i> Update Order
        </button>
        <!-- Tombol Back -->
        <a class="btn btn-custom btn-custom-secondary ml-2" href="{{ route('employee.index') }}">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const statusSelect = document.getElementById('status');
    const deliveryDateGroup = document.getElementById('delivery-date-group');

    function toggleDeliveryDate() {
        if (statusSelect.value === 'delivered') {
            deliveryDateGroup.style.display = 'block';
        } else {
            deliveryDateGroup.style.display = 'none';
        }
    }

    statusSelect.addEventListener('change', toggleDeliveryDate);

    // Initial check
    toggleDeliveryDate();
});
</script>
@endsection
