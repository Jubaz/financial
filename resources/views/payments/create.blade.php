@extends('layouts.app')

@section('content')
    <div class="row">

        <div class="col-md-8 order-md-1">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul style="margin-top: 0;margin-bottom: 0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h4 class="mb-3">Create payment</h4>
            <form class="needs-validation" novalidate="" method="POST" action="{{ route('payments.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="amount">Amount</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="number" class="form-control" id="amount" name="amount" placeholder="Please enter your amount" value="{{ old('amount') }}" required>
                        <div class="invalid-feedback" style="width: 100%;">
                            Your amount is required.
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="comment">Comment <span class="text-muted">(Optional)</span></label>
                    <textarea rows="4" class="form-control" id="comment" name="comment">{{ old('comment') }}</textarea>
                    <div class="invalid-feedback">
                        Please enter a valid comment.
                    </div>
                </div>

                <hr class="mb-4">

                <h4 class="mb-3">Payment type</h4>

                <div class="d-block my-3">
                    <div class="custom-control custom-radio">
                        <input id="credit" name="paymentMethod" value="credit" type="radio" class="custom-control-input" {{ (old('paymentMethod') == 'credit')? 'checked' :'' }} required="">
                        <label class="custom-control-label"  for="credit">Credit (use this for income)</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="debit" name="paymentMethod" value="debit" type="radio" class="custom-control-input" {{ (old('paymentMethod') == 'debit')? 'checked' :'' }} required="">
                        <label class="custom-control-label" for="debit">Debit (use this for expenses)</label>
                    </div>
                </div>

                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
            </form>
        </div>
    </div>
@endsection


@push('js')
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
@endpush