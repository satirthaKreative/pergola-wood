@extends('frontend.app')
@section('content')
<style>
    .transaction-error-page{
        background-color: red !important;
    }
</style>
<div class="sec1">
  <img src="{{ asset('frontend/images/close.svg') }}" alt="">
  <h2>Transaction Error</h2>
  <p>Your Order Not Placed </p>
  <a href="{{ route('satirtha.home') }}" class="transaction-error-page">Continue to homepage</a>
</div>
@endsection