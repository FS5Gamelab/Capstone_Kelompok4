@extends('employee.order')

@section('content')
<br> <br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Pay COD') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('processPayCOD', $order->id) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="amount_paid" class="col-md-4 col-form-label text-md-right">{{ __('Amount Paid') }}</label>

                            <div class="col-md-6">
                                <input id="amount_paid" type="number" class="form-control @error('amount_paid') is-invalid @enderror" name="amount_paid" value="{{ old('amount_paid') }}" required autofocus>

                                @error('amount_paid')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
