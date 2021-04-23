@extends('frontend.app')
@section('content')
<div class="sec1">
  <img src="{{ asset('frontend/images/checked.svg') }}" alt="">
  <h2>Thank You!</h2>
  <p>Your Order Placed Successfully Done</p>
  <a href="{{ route('satirtha.home') }}">Continue to homepage</a>
</div>
@endsection
@section('jsContent')
<script>
  $(function(){
    load_thankyou_order_fx();
  });

  function load_thankyou_order_fx()
  {
    var order_id = "{{ $_GET['OrderID'] }}";
    var full_price = "{{ $_GET['FullTotal'] }}";
    var payment_type = "{{ $_GET['PaymentType'] }}";
    $.ajax({
      url: "{{ route('satirtha.payment-order-admin') }}",
      type: "GET",
      data: {order_id: order_id, full_price: full_price, payment_type: payment_type},
      dataType: "json",
      success: function(event)
      {

      },
      error: function(event)
      {
        
      }
    })
  }
</script>
@endsection