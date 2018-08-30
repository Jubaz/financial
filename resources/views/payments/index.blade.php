@extends('layouts.app')

@section('content')

    <div class="row">

        <div style="margin-bottom: 20px" class="col-lg-12">
            <a href="{{ route('payments.create') }}" class="btn btn-outline-primary">Create new payment</a>
            <a href="{{ route('payments.index') }}" class="btn btn-outline-primary">All payment</a>
            <a href="{{ route('payments.index','type=credit') }}" class="btn btn-outline-primary">Income payment</a>
            <a href="{{ route('payments.index','type=debit') }}" class="btn btn-outline-primary">Expenses payment</a>
        </div>

        <div class="col-lg-12">
            <table class="table table-striped table-dark">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Created at</th>
                    <td scope="col">Amount</td>
                    <td scope="col">type</td>
                    <th scope="col">Change</th>
                    <td scope="col">Your Comments</td>
                </tr>
                </thead>
                <tbody>
                <?php $counter = 1; ?>
                @foreach($payments as $payment)
                    <tr>
                        <th scope="row">{{ $counter ++ }}</th>
                        <td>{{ $payment->created_at->diffForHumans() }}</td>
                        @if($payment->type == 'credit')
                            <td>{{ $payment->balance_before + $payment->balance_after }}</td>
                        @else
                            <td>{{ $payment->balance_before - $payment->balance_after }}</td>
                        @endif
                        <td>{{ $payment->type }}</td>
                        <td>{{ $payment->balance_before.' => '.$payment->balance_after }}</td>
                        <td>{{ $payment->comment }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection