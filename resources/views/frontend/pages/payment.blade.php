@extends('frontend.app')
@section('content')
<section class="payment_area">
  <div class="container">
      <div class="row">
        <div class="col-md-6 col-sm-6 bill_form">
          <h2>Billing Details</h2>        
            <div class="row">
                <div class="col-md-6 col-sm-6">
                  <label>First name <span>*</span></label>
                  <input type="text" name="first_name" id="first-name-id">
                </div>
                <div class="col-md-6 col-sm-6">
                  <label>Last name <span>*</span></label>
                  <input type="text" name="last_name" id="last-name-id">
                </div>
                <div class="col-md-12">
                  <label>Company name (optional)</label>
                  <input type="text" name="company_name" id="company-name-id">
                </div>
                <div class="col-md-12">
                  <label>Street address <span>*</span></label>
                  <input type="text" id="street1-address-id" name="street1_address_name" placeholder="House number and street name">
                  <input type="text" id="street2-address-id" name="street2_address_name" placeholder="Apartment, suite, unit etc. (optional)">
                </div>
                <div class="col-md-12">
                  <label>Town / City <span>*</span></label>
                  <input type="text" name="city_name" id="city-name-id">
                </div>
                <div class="col-md-12">
                  <label>Province / State <span>*</span></label>
                  <input type="text" name="state_name" id="state-name-id" placeholder="Enter an option">
                </div>
                <div class="col-md-12">
                  <label>Country / Region <span>*</span></label>
                  <select name="country_name" id="country-name-id">
                    <option value="">Select a country / region…</option>
                    <option value="CA" id="CA">Canada</option>
                    <option value="US" id="US">United States (US)</option>
                  </select>
                </div>
                <div class="col-md-12">
                  <label>Postcode / ZIP <span>*</span></label>
                  <input type="text" name="zipcode_name" id="zipcode-id">
                </div>
                <div class="col-md-6 col-sm-6">
                  <label>Phone <span>*</span></label>
                  <input type="tel" name="phone_name" id="phone-number-id">
                </div>
                <div class="col-md-6 col-sm-6">
                  <label>Email <span>*</span></label>
                  <input type="email" name="email_address" id="email-id">
                </div>
                <input type="hidden" name="pay_hidden_name" id="pay-hidden-name-id" value="no">
                <div class="col-md-12 check_area">
                  <label for="option-1"><input type="checkbox" name="option-1" id="option-1">SHIP TO A DIFFERENT ADDRESS?</label>
                </div>

                
                <div class="col-md-12" id="actions" hidden>
                    <div class="row">
                      <div class="col-md-6 col-sm-6">
                        <label>First name <span>*</span></label>
                        <input type="text" name="first_name2" id="fname-id2">
                      </div>
                      <div class="col-md-6 col-sm-6">
                        <label>Last name <span>*</span></label>
                        <input type="text" name="last_name2" id="lname-id2">
                      </div>
                      <div class="col-md-6 col-sm-6">
                        <label>Company name (optional)</label>
                        <input type="text" name="company_name2" id="company-name-id2">
                      </div>
                      <div class="col-md-6 col-sm-6">
                        <label>Country / Region <span>*</span></label>
                        <select name="country_name2" id="country-name-id2">
                          <option value="">Select a country / region…</option>
                        <option value="CA" id="CA">Canada</option>
                        <option value="US" id="US">United States (US)</option>
                        </select>
                      </div>
                      <div class="col-md-12">
                        <label>Street address <span>*</span></label>
                        <input type="text" id="street1-address-name-id2" name="street1_address_name2" placeholder="House number and street name">
                        <input type="text" id="street2-address-name-id2" name="street2_address_name2" placeholder="Apartment, suite, unit etc. (optional)">
                      </div>
                      <div class="col-md-12">
                        <label>Town / City <span>*</span></label>
                        <input type="text" name="city_name2" id="city-name-id2">
                      </div>
                      <div class="col-md-12">
                        <label>State / County <span>*</span></label>
                        <input type="text" name="state_name2" id="state-name-id2" placeholder="Select an option">
                      </div>
                      <div class="col-md-12">
                        <label>Postcode / ZIP <span>*</span></label>
                        <input type="text" name="zipcode_name2" id="zipcode-id2">
                      </div>
                    </div>
                </div>
                <div class="col-md-12">
                  <label>Order notes (optional)</label>
                  <textarea name="order_notes_name" id="order-notes-id" rows="4" cols="" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                </div>
            </div>
            
        </div>
        <div class="col-md-6 col-sm-6 pay_right">
          <h2>YOUR ORDER</h2>
          <table>
            <tr>
              <th width="70%">Product</th>
              <th>Subtotal</th>
            </tr>
            <tr>
              <td>Pergola</td>
              <td>$<span class="price-val-class">0</span></td>
            </tr>
            <tr class="total">
              <td>Total</td>
              <input type="hidden" name="price_val_hidden_name" value="0" id="price-val-id">
              <td>$<span class="price-val-class">0</span></td>
            </tr>
          </table>
          <div class="pay_option">
            <label><input type="radio" name="tab" value="igotone" onclick="show1();" />  Credit Card (PsiGate) <img src="{{ asset('frontend/images/visa.png') }}"> <img src="{{ asset('frontend/images/mastercard.png') }}"></label>
            <div id="div1" class="hide">
              <p>Please make sure you enter your correct billing information.</p>
              
              <div class="row">
              <FORM ACTION='https://stagingcheckout.psigate.com/HTMLPost/HTMLMessenger' id="card-panel-psi-id" METHOD=post>
                <INPUT TYPE=HIDDEN NAME="StoreKey" id="merchant-card-capture-id"  VALUE="merchantcardcapture200024">
                <INPUT TYPE=HIDDEN NAME="SubTotal" id="subtotal-total-hidden-pay-id" VALUE="0">
                <INPUT TYPE=HIDDEN NAME="PaymentType" VALUE="CC">
                <INPUT TYPE=HIDDEN NAME="CardAction" VALUE="0">
                <div class="col-md-12">
                  <label>Card Number <span>*</span></label>
                  <input type="text" name="CardNumber" placeholder="•••• •••• •••• ••••" maxlength="16">
                </div>
                <div class="col-md-6 col-sm-6">
                  <label>Expiry (MM) <span>*</span></label>
                  <input type="text" name="CardExpMonth" placeholder="MM" maxlength="2">
                </div>
                <div class="col-md-6 col-sm-6">
                  <label>Expiry (YY) <span>*</span></label>
                  <input type="text" name="CardExpYear" placeholder="YY" maxlength="2">
                </div>
                <div class="col-md-12 col-sm-6">
                  <label>Card Code <span>*</span></label>
                  <input type="number" name="CardIDNumber" placeholder="CVC">
                </div>
                <INPUT TYPE="hidden" NAME="ThanksURL" VALUE="{{ route('satirtha.show-thank-you-page') }}">
                <INPUT TYPE="hidden" NAME="NoThanksURL" VALUE="https://stagingcheckout.psigate.com/HTMLPost/generic_nothankyou.jsp">

                <!--Posts the transaction to PSiGate-->
              </form>
              </div>
              

            </div>
            <label><input type="radio" name="tab" value="igottwo" onclick="show2();" />PayPal <img src="{{ asset('frontend/images/paypal.png') }}"></label>
            
            <div id="div2" class="hide">
              <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
            Two
            </div>
          </div>
          <div class="term">
            <label><input type="checkbox" name="option-2"> I have read and agree to the website terms and conditions <span>*</span></label>
            <form action="{!! URL::to('paypal') !!}" method="POST" id="payment-form">
            {{ csrf_field() }}
              <input type="hidden" name="amount" value="0" id="price-val-id" />
              <a class="btn btn-success" id="back-to-home-new-session-btn" href="javascript: ;" onclick="back_to_home_fx()">Back</a>
              <input type="submit" id="place-order-submit-btn-id" name="place_order_submit_btn_name" value="Place Order">
            </form>
            <div class="clearfix"></div>
          </div>
            
        </div>
      </div>  
  </div>
</section>
@endsection
@section('jsContent')
<script>

    $(function(){
      load_price_view();
      $("#country-name-id").change(function(e){
        var change_state_panel = $("#country-name-id").val();
        $.ajax({
          url: "{{ route('satirtha.payment-load-price-panel') }}",
          type: "GET",
          dataType: "json",
          success: function(event){
            if(change_state_panel == "CA")
            {
              var price_usd = parseInt(event);
              var price_cad = 1.25*price_usd;
              $(".price-val-class").html(price_cad + " CAD");
              $("#subtotal-total-hidden-pay-id").val(price_cad);
              $(".price-val-id").val(price_cad);
              $("#merchant-card-capture-id").val("merchantcardcapture200024");
            }
            else
            {
              $("#subtotal-total-hidden-pay-id").val(event);
              $(".price-val-class").html(event + " USD");
              $(".price-val-id").val(event);
              $("#merchant-card-capture-id").val("merchantcardcapture200024");
            }
          }, error: function(event){

          }
        })
      });
    });

    function load_price_view()
    {
      $.ajax({
        url: "{{ route('satirtha.payment-load-price-panel') }}",
        type: "GET",
        dataType: "json",
        success: function(event){
          $("#subtotal-total-hidden-pay-id").val(event);
          $(".price-val-class").html(event + " USD");
          $(".price-val-id").val(event);
          $("#merchant-card-capture-id").val("merchantcardcapture200024");
        }, error: function(event){

        }
      })
    }

    function show1(){
      document.getElementById('div1').style.display ='block';
      document.getElementById('div2').style.display ='none';
    }
    function show2(){
      document.getElementById('div2').style.display = 'block';
      document.getElementById('div1').style.display = 'none';
    }

    $( document ).ready(function() {
        
        var checkboxes = $("input[name='option-1']"),
        actions = $("#actions");

        checkboxes.click(function() {
        
          actions.attr("hidden", !checkboxes.is(":checked"));
          
        });
          
    });

    $("#place-order-submit-btn-id").on('click',function(e){
      e.preventDefault();

      var first_name = $("#first-name-id").val();
      var last_name = $("#last-name-id").val();
      var company_name = $("#company-name-id").val();
      var street1_name = $("#street1-address-id").val();
      var street2_name = $("#street2-address-id").val();
      var city_name = $("#city-name-id").val();
      var state_name = $("#state-name-id").val();
      var country_name = $("#country-name-id").val();
      var zip_code_name = $("#zipcode-id").val();
      var phone_number = $("#phone-number-id").val();
      var email_name = $("#email-id").val();

      var hidden_pay_check = $("#pay-hidden-name-id").val();
      if(hidden_pay_check == "yes")
      {
        var pay_state_status = "yes";
        var first_name2 = $("#first-name-id2").val();
        var last_name2 = $("#last-name-id2").val();
        var company_name2 = $("#company-name-id2").val();
        var street1_name2 = $("#street1-address-name-id2").val();
        var street2_name2 = $("#street2-address-name-id2").val();
        var city_name2 = $("#city-name-id2").val();
        var state_name2 = $("#state-name-id2").val();
        var country_name2 = $("#country-name-id2").val();
        var zip_code_name2 = $("#zipcode-id2").val();
        if(first_name == "")
        {
          error_pass_alert_show_msg("Please enter a first name");
        }
        else if(last_name == "")
        {
          error_pass_alert_show_msg("Please enter a last name");
        }
        else if(street1_name == "")
        {
          error_pass_alert_show_msg("Please enter a street address");
        }
        else if(street1_name == "")
        {
          error_pass_alert_show_msg("Please enter a street address");
        }
        else if(city_name == "")
        {
          error_pass_alert_show_msg("Please enter a city address");
        }
        else if(state_name == "")
        {
          error_pass_alert_show_msg("Please enter a state address");
        }
        else if(country_name == "")
        {
          error_pass_alert_show_msg("Please enter a country address");
        }
        else if(first_name2 == "")
        {
          error_pass_alert_show_msg("Please enter a first name");
        }
        else if(last_name2 == "")
        {
          error_pass_alert_show_msg("Please enter a last name");
        }
        else if(street1_name2 == "")
        {
          error_pass_alert_show_msg("Please enter a street address");
        }
        else if(street1_name2 == "")
        {
          error_pass_alert_show_msg("Please enter a street address");
        }
        else if(city_name2 == "")
        {
          error_pass_alert_show_msg("Please enter a city address");
        }
        else if(state_name2 == "")
        {
          error_pass_alert_show_msg("Please enter a state address");
        }
        else if(country_name2 == "")
        {
          error_pass_alert_show_msg("Please enter a country address");
        }
        else
        {
          if($("input[name='tab']").is(':checked')) { 
            $.ajax({
              url:  "{{ route('satirtha.payment-submit-panel') }}",
              type: "GET",
              data: {pay_state_status: pay_state_status, first_name: first_name, last_name: last_name, company_name: company_name, street1_name: street1_name, street2_name: street2_name, city_name: city_name, state_name: state_name, country_name: country_name, zip_code_name: zip_code_name, phone_number: phone_number, email_name: email_name, first_name2: first_name2, last_name2: last_name2, company_name2: company_name2, street1_name2: street1_name2, street2_name2: street2_name2, city_name2: city_name2, state_name2: state_name2, country_name2: country_name2, zip_code_name2: zip_code_name2 },
              dataType: "json",
              success: function(event){
                console.log(event);
                if(event == "success"){
                  if($('input[name=tab]:checked', '.pay_option').val() == "igotone"){
                    $("#card-panel-psi-id").submit();
                  }else if($('input[name=tab]:checked', '.pay_option').val() == "igottwo"){
                    $('#payment-form').submit();
                  }
                  //
                }else if(event == "error"){
                  
                }
              }, error: function(event){

              }
            });
          }else{
            error_pass_alert_show_msg("choose a payment type");
          }
        }
      }
      else if(hidden_pay_check == "no")
      {
        if(first_name == "")
        {
          error_pass_alert_show_msg("Please enter a first name");
        }
        else if(last_name == "")
        {
          error_pass_alert_show_msg("Please enter a last name");
        }
        else if(street1_name == "")
        {
          error_pass_alert_show_msg("Please enter a street address");
        }
        else if(street1_name == "")
        {
          error_pass_alert_show_msg("Please enter a street address");
        }
        else if(city_name == "")
        {
          error_pass_alert_show_msg("Please enter a city address");
        }
        else if(state_name == "")
        {
          error_pass_alert_show_msg("Please enter a state address");
        }
        else if(country_name == "")
        {
          error_pass_alert_show_msg("Please enter a country address");
        }
        else
        {
          if($("input[name='tab']").is(':checked')) { 
            var pay_state_status = "no";
            $.ajax({
              url:  "{{ route('satirtha.payment-submit-panel') }}",
              type: "GET",
              data: {pay_state_status: pay_state_status, first_name: first_name, last_name: last_name, company_name: company_name, street1_name: street1_name, street2_name: street2_name, city_name: city_name, state_name: state_name, country_name: country_name, zip_code_name: zip_code_name, phone_number: phone_number, email_name: email_name },
              dataType: "json",
              success: function(event){
                if(event == "success"){
                  if($('input[name=tab]:checked', '.pay_option').val() == "igotone"){
                    $("#card-panel-psi-id").submit();
                  }else if($('input[name=tab]:checked', '.pay_option').val() == "igottwo"){
                    $('#payment-form').submit();
                  }
                  // 
                }else if(event == "error"){

                }
              }, error: function(event){
                
              }
            });
          }
          else{
            error_pass_alert_show_msg("choose a payment type");
          }
          
        }
      }

    });

    $("#option-1").on('click',function(e){
      if($("#option-1").is(':checked')){
        $("#pay-hidden-name-id").val('yes');
      }else{
        $("#pay-hidden-name-id").val('no');
      }
    });
    
    // clicking to main home page on last panel
    function back_to_home_fx()
    {
      $.ajax({
        url: "{{ route('satirtha.backToHomePage') }}",
        type: "GET",
        dataType: "json",
        success: function(event){
          window.location.href="{{ route('satirtha.home') }}";
        }, error: function(event){
          
        }
      })
    }
</script>
@endsection