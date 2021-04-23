@extends('frontend.app')
@section('content')
<style>
#checkout-pay-btn-id {
    margin: 64px auto 0;
    display: inline-block;
    min-width: 160px;
    padding: 0 35px;
    height: 55px;
    border-radius: 4px;
    background-color: #718b38;
    border: none;
    font-size: 16px;
    font-weight: 700;
    font-style: normal;
    letter-spacing: 0.48px;
    line-height: normal;
    text-align: center;
    text-transform: uppercase;
    color: #fff;
    line-height: 55px;
}
.pergola-canopy-panel-class p{
    color: #000000 !important;
    font-size: 14px !important;
    font-weight: 300 !important;
    font-style: normal !important;
    letter-spacing: normal !important;
    line-height: 28px !important;
    text-align: justify !important;
    margin: 0 0 30px !important;
}
</style>
<!-- MultiStep Form -->
<section class="body-cont1">
  <div class="container">
    <form id="msform">
        <fieldset id="jio-first-panel-id">    
         <div class="row">
           <div class="col-lg-12 text-center">
             <h2>Custom Pergola Builder</h2>             
           </div>
           <div class="col-lg-6">
             <h3>Pick a Footprint (outside post to post)</h3>
             <input type="hidden" name="pick_footprint_hide_data_change_panel" id="pick_footprint_hide_data_change_panel" value="0" />
             <label for="">Width (In Feet) *</label>
             <select name="" id="master-home-width-id" onchange="master_home_width_fx()">
               <option value="">Choose a width</option>
             </select>
              <label for="">Length (In Feet) *</label>
             <select name="" id="master-home-height-id" onchange="master_home_height_fx()">
               <option value="">Choose a length</option> 
             </select>
             <div class="master-post-div-panel-class">
              <label for="">Post *</label>
              <select name="" id="master-home-post-id" onchange="change_master_post_fx()">
                <option value="">Choose posts</option>
              </select>
             </div>
             <h3>Price would be Calculated for a Standard <span id="master-new-combine-width-id"></span>x<span id="master-new-combine-height-id"></span> Pergola Now</h3>
             <table>
               <tr>
                <td>Total Price </td>
                <input type="hidden" name="" id="first-page-price-hidden-id" value="0">
                <td>$<span id="master-panel-price-id">0</span></td>
              </tr>
             </table>
           </div>
           <div class="col-lg-6">
             <div class="img-wrap" id="master-img-panel-page1-id">
               
             </div>
           </div>
         </div>
         <input type="button" name="next" id="first-page-to-next-id" class="next action-button-next button" value="Next" />
        </fieldset>
        <fieldset>
         <div class="row">
           <div class="col-lg-12 text-center">
             <h2>Custom Pergola Builder</h2>             
           </div>
           <div class="col-lg-6">
            <input type="hidden" name="pick_overhead_shades_hide_data_change_panel" id="pick_overhead_shades_hide_data_change_panel" value="0" />
             <h3>Pick Overhead Shades</h3>
             <label for="">Ladder Spacing *</label>
             <select name="" id="ladder-overhead-datas-show-id" onchange="overhead_shades2_change_fx()">
               <option value="">Choose a overhead shades</option>
             </select> 
             <table>
               <tr>
                <td>Total Price </td>
                <input type="hidden" name="" id="second-page-price-hidden-id" value="0">
                <td>$<span id="second-price-panel-id">0</span></td>
              </tr>
             </table>
           </div>
           <div class="col-lg-6">
             <div class="img-wrap" id="second-image-panel-id">
               
             </div>
           </div>
         </div>
          <input type="button" name="previous" class="previous action-button-previous button" value="Back" />
          <input type="button" name="next" class="next action-button-next button" id="second-page-to-next-id" value="Next" />
        </fieldset>
        <fieldset>
         <div class="row">
           <div class="col-lg-12 text-center">
             <h2>Custom Pergola Builder</h2>             
           </div>           
           <div class="col-lg-12">
             <div class="img-wrap" id="new-custom-third-val-id">
              <iframe id='3dviewerplayer' type='text/html' width='640' height='480' src='' frameborder='0' scrolling='no' allowfullscreen webkitallowfullscreen mozallowfullscreen></iframe>
             </div>
           </div>
         </div>
          <input type="button" name="previous" class="previous action-button-previous button" value="Back" />
          <input type="button" name="next" class="next action-button-next button" id="third-page-to-next-id" value="Next" />
        </fieldset>
        <fieldset>
         <div class="row">
           <div class="col-lg-12 text-center">
             <h2>Custom Pergola Builder</h2>             
           </div>
           <div class="col-lg-6">
             <h3>Pick Post Length</h3>
             <input type="hidden" name="pick_post_length_hide_data_change_panel" id="pick_post_length_hide_data_change_panel" value="0" />
             <label for="">Post Length (In Feet )*</label>
             <select name="" id="fourth-page-post-length-id" onchange="choose_fourth_page_data_fx4()">
               <option value="">Choose a post length</option>
             </select> 
             <input type="hidden" name="" id="fourth-page-price-hidden-id" value="0">
             <h4>Price <span>$<span id="fourth-price-panel-id">0</span></span></h4>
             <table>
               <tr>
                <td>Total Price </td>
                <td>$<span id="fourth-total-price-panel-id">0</span></td>
              </tr>
             </table>
           </div>
           <div class="col-lg-6">
             <div class="img-wrap" id="fourth-img-panel-view-id">
               
             </div>
           </div>
         </div>
          <input type="button" name="previous" class="previous action-button-previous button" value="Back" />
          <input type="button" name="next" id="fourth-page-to-next-id" class="next action-button-next button" value="Next" />
        </fieldset>
        <fieldset>
         <div class="row">
           <div class="offset-lg-3 col-lg-6 text-center">
             <h2>Custom Pergola Builder</h2>  
             <h6>Pick Post Mount Bracket</h6> 
             <ul class="Canopy1 checking-radio-panel-of-slap-class">
              <input type="hidden" id="mount_answer_hidden_id" name="mount_answer_hidden" value="no">
                <li>
                  <input type="radio"  name="bracket1" value="yes" class="pick-post-mount-bracket-class-yes-type">Yes
                </li>
                <li>
                 <input type="radio"  name="bracket1" value="no" class="pick-post-mount-bracket-class-no-type">No
                </li>
             </ul>
             <div class="pick-slap-select-panel-class">
                <label for="">Pick Slab *</label>
                <select name="" id="pick-slap-mount-panel-load-id" onchange="pick_slap_types_fx5()">
                  <option value="">Choose a pick slap</option>
                </select>
             </div>  
             <input type="hidden" name="" id="fifth-page-price-hidden-id" value="" />
             <input type="hidden" id="mount-hidden-panel-price-new-id" value="0" />
             <h4>Price <span>$<span id="fifth-price-panel-id">0</span></span></h4>
             <table>
               <tr>
                <td>Total Price </td>
                <td>$<span id="fifth-total-price-panel-id">0</span></td>
              </tr>
             </table>         
           </div>  
         </div>
          <input type="button" name="previous" class="previous action-button-previous button" value="Back" />
          <input type="button" name="next" id="fifth-page-to-next-id" class="next action-button-next button" value="Next" />
        </fieldset>
        <fieldset>
         <div class="row">
           <div class="offset-lg-3 col-lg-6 text-center">
             <h2>Custom Pergola Builder</h2>  
             <h6>Pick Retactable Canopy</h6> 
             
             <ul class="Canopy1 checking-radio-panel-of-canopy-class">
             <input type="hidden" id="canopy_answer_hidden_id" name="canopy_answer_hidden" value="no">
               <li>
                 <input type="radio" name="bracket2" value="yes" class="pick-post-canopy-class-yes-type">Yes
               </li>
                <li>
                 <input type="radio" name="bracket2" value="no" class="pick-post-canopy-class-no-type">No
               </li>
             </ul>
             <div class="canopy-note-select-panel-class pergola-canopy-panel-class">
              
             </div>
             <table>
               <tr>
                <td>Total Price </td>
                <input type="hidden" name="" id="sixth-panel-price-hidden-id" value="" />
                <td>$<span id="sixth-total-price-panel-id">0</span></td>
              </tr>
             </table>         
           </div>  
         </div>
          <input type="button" name="previous" class="previous action-button-previous button" value="Back" />
          <input type="button" name="next" id="sixth-page-to-next-id" class="next action-button-next button" value="Next" />
        </fieldset>
        <fieldset>
         <div class="row">
           <div class="offset-lg-3 col-lg-6 text-center">
             <h2>Custom Pergola Builder</h2>  
             <h6>Pick Louvered Panel</h6> 
             <p>Go to link about Louvered Panels? *</p>
             <ul class="Canopy1 checking-radio-panel-of-lpanel1-class">
             <input type="hidden" id="lpanel_answer_hidden_id" name="lpanel_answer_hidden" value="no">
               <li>
                 <input type="radio" name="bracket3" value="yes" class="pick-lpanel-yes-type-new">Yes
               </li>
                <li>
                 <input type="radio" name="bracket3" value="no" class="pick-lpanel-no-type-new">No
               </li>
             </ul>

              <ul class="Canopy2 checking-radio-panel-of-lpanel2-class">
               
             </ul> 

             <input type="hidden" id="lpanel-hide-radio-btn-panel-price-id" val="0" />           
             <h4>Price <span>$<span id="lpanel-wish-price-id">0</span></span></h4>
             <table>
               <tr>
                <td>Total Price </td>
                <input type="hidden" name="" id="seventh-panel-price-hidden-id" value="" />
                <td>$<span id="seventh-total-price-panel-id">0</span></td>
              </tr>
             </table>         
           </div>  
         </div>
          <input type="button" name="previous" class="previous action-button-previous button" value="Back" />
          <input type="button" name="next" class="next action-button-next button" id="seventh-page-to-next-id" value="Next" />
        </fieldset>

        <fieldset id="jio-final-panel">
         <div class="row">
           <div class="col-lg-12 text-center">
           <h2>Custom Pergola Builder</h2> 
           </div>
           <div class="col-lg-4 text-center">
             
             <h3>View Your Pergola</h3> 
             <label for="">Selected Pergola:</label>
            
            <ul class="Pergola">
              <li>
                <h5>Width</h5>
                <p><span id="final-product-width">0</span> Ft</p>
              </li>
              <li>
                <h5>Length</h5>
                <p><span id="final-product-length">0</span> Ft</p>
              </li>
              <li>
                <h5>Post Length</h5>
                <p><span id="final-product-post-length">0</span> Ft</p>
              </li>
              <li>
                <h5>Overhead Shade</h5>
                <p><span id="final-product-overhead">0</span></p>
              </li>
              <li>
                <h5>Mount Bracket</h5>
                <p><span id="final-product-mount">0</span></p>
              </li>
              <li>
                <h5>Retactable Canopy</h5>
                <p><span id="final-product-canopy">0</span></p>
              </li>
              <li>
                <h5>Louvered Panel</h5>
                <p><span id="final-product-lpanel">0</span></p>
              </li>
            </ul>
             <table>
               <tr>
                <td>Total Price </td>
                <td>$<span id="final-product-total-price-id">0</span></td>
              </tr>
             </table> 
             <label for="">Select the action ( Take Printout, Generate PDF or Send Email )</label>   
             <ul class="print-sec">
               <li><a href="javascript:;" onClick="window.print()"> <i class="fas fa-print"></i> Print</a></li>
               <li><a href="{{ route('satirtha.generate-pdf') }}" target="_blank"><i class="far fa-file-pdf"></i> PDF</a></li>
               <li><a href="#" data-toggle="modal" data-target="#myModal"><i class="far fa-envelope"></i> Email</a></li>
             </ul>    
           </div>  
           <div class="col-lg-8">
             <div class="img-wrap final-product-img-final-class">
               
             </div>
           </div>
         </div>
          <input type="button" name="previous" class="previous action-button-previous button" value="Back"  />
          <input type="button" name="next" class="action-button-next button" id="last-getting-next-id" value="view Footprint of pergola" />
          <a href="{{ route('satirtha.show-payment') }}" name="pay" class="button" id="checkout-pay-btn-id">Checkout</a>
          </fieldset>
        <fieldset>
         <div class="row">
           <div class="col-lg-12 text-center">
             <h2>Custom Pergola Builder</h2> 
            
            <div class="last-footprint-img-class">
            
            </div>
            <label for="">Select the action ( Take Printout, Generate PDF or Send Email )</label>   
             <ul class="print-sec">
               <li><a href="javascript:;" onClick="window.print()"> <i class="fas fa-print"></i> Print</a></li>
               <li><a href="{{ route('satirtha.generate-last-pdf') }}" target="_blank"><i class="far fa-file-pdf"></i> PDF</a></li>
               <li><a href="#" data-toggle="modal" data-target="#myModal"><i class="far fa-envelope"></i> Email</a></li>
             </ul>     
           </div>  
         </div>
          <input type="button" name="previous" class="previous action-button-previous button" value="Back" />
          <a href="{{ route('satirtha.show-payment') }}" name="pay" class="button" id="checkout-pay-btn-id">Checkout</a>
        </fieldset>
      </form>
  </div>
</section>
<!-- The Modal -->
      <div class="modal fade email-modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Send Email</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-3">
                  <label for="">Name</label>
                </div>
                <div class="col-lg-9">
                  <input type="text" id="send-form-name-id">
                </div>
                 <div class="col-lg-3">
                  <label for="">Email</label>
                </div>
                <div class="col-lg-9">
                  <input type="email" id="send-form-email-id">
                </div>
                 <div class="col-lg-3">
                  <label for="">Comment</label>
                </div>
                <div class="col-lg-9">
                  <textarea name="" id="send-form-comment-id"></textarea>
                </div>
                <div class="col-lg-12">
                  <input type="button" value="submit" onclick="submit_Send_mail_fx()">
                </div>
              </div>             
            </div>
          </div>
        </div>
      </div>
<!-- end of modal -->
@endsection
@section('jsContent')
@if(Session::has('main_back_session_key'))
<script>
  $("#jio-final-panel").show();
  $("#jio-first-panel-id").hide();
  $.ajax({
    url: "{{ route('satirtha.forget-new-session-back-to-home') }}",
    type: "GET",
    dataType: "json",
    success: function(event){

    }, error: function(event){

    }
  });
</script>
@endif
<script>
$(function(){
  
  $(".pick-slap-select-panel-class").css("display","none");
  $(".canopy-note-select-panel-class").css("display","none");
  $(".checking-radio-panel-of-lpanel2-class").css("display","none");
  master_width_fx();
  master_height_fx();
});
</script>
@if(Session::has('main_unique_session_key'))
<script>
  $(".master-post-div-panel-class").css("display","block");
  show_page_loading_after_back_fx();
  function show_page_loading_after_back_fx()
  {
    $.ajax({
      url: "{{ route('satirtha.main_pass_load_back_home_panel_session') }}",
      type: "GET",
      dataType: "json",
      success: function(event){
        console.log(event);
        $("#master-home-post-id").html(event.main_posts);

        $("#master-panel-price-id").html(event.master_price);
        $("#first-page-price-hidden-id").val(event.master_price);
        $("#master-img-panel-page1-id").html(event.master_img);


        $("#ladder-overhead-datas-show-id").html(event.overhead_types);
        var first_price11 = $("#first-page-price-hidden-id").val();
        var second_price12 = parseInt(first_price11) + parseInt(event.master_overhead_price);
        $("#second-page-price-hidden-id").val(second_price12);
        $("#second-price-panel-id").html(second_price12);
        $("#second-image-panel-id").html(event.master_overhead_img);


        $("#new-custom-third-val-id").find("#3dviewerplayer").attr('src',event.video_data);

        $("#fourth-page-post-length-id").html(event.master_post_length);
        $("#fourth-price-panel-id").html(event.master_post_length_price);
        var second_price42 = parseInt(event.master_post_length_price) + parseInt(second_price12);
        $("#fourth-img-panel-view-id").html(event.master_post_length_img);

        $("#fourth-total-price-panel-id").html(second_price42);
        $("#fourth-page-price-hidden-id").val(second_price42);

        

        // slap
        if(event.final_post_mount_type == "yes")
        {
          
          $(".pick-slap-select-panel-class").css('display','block');
              var step1_price = parseInt($("#fourth-page-price-hidden-id").val());
              var step2_price = parseInt(event.final_post_mount);
              var main_step3_price = step1_price + step2_price;
              $("#pick-slap-mount-panel-load-id").html(event.choose_pick_slap_html);
              $("#fifth-page-price-hidden-id").val(main_step3_price);
              $("#fifth-total-price-panel-id").html(main_step3_price); 
              $("#fifth-price-panel-id").html(step2_price);  
              $("#mount-hidden-panel-price-new-id").val(step2_price); 
              $(".pick-post-mount-bracket-class-yes-type").attr('checked','checked');
        }
        else
        {
          $(".pick-slap-select-panel-class").css('display','none');
          var fourth_price = parseInt($("#fourth-page-price-hidden-id").val());
            $("#fifth-page-price-hidden-id").val(fourth_price);
            $("#fifth-total-price-panel-id").html(fourth_price);  
            $("#fifth-price-panel-id").html('0');  
            $("#mount-hidden-panel-price-new-id").val('0');
            $(".pick-post-mount-bracket-class-no-type").attr('checked','checked');
        }

        // slap checking

        if(event.show_canopy_type == "yes")
        {
          $(".canopy-note-select-panel-class").css('display','block');
          $("#canopy_answer_hidden_id").val("yes");
          $(".canopy-note-select-panel-class").html(event.canopy_session_name);
              var first_price = parseInt($("#fifth-page-price-hidden-id").val());
              var second_price = parseInt(event.show_canopy_name_price);
              var total_price = first_price + second_price;
              $("#sixth-total-price-panel-id").html(total_price);
              $("#sixth-panel-price-hidden-id").val(total_price);
              $(".pick-post-canopy-class-yes-type").attr("checked","checked");
        }
        else
        {
          $(".canopy-note-select-panel-class").css('display','none');
          $("#canopy_answer_hidden_id").val("no");
              $("#sixth-total-price-panel-id").html($("#fifth-page-price-hidden-id").val());
              $("#sixth-panel-price-hidden-id").val($("#fifth-page-price-hidden-id").val());
              $(".pick-post-canopy-class-no-type").attr("checked","checked");
        }


        // end canopy

        if(event.show_lpanel_type == "yes")
        {
          $(".pick-lpanel-yes-type-new").attr('checked','checked');
          $(".checking-radio-panel-of-lpanel2-class").css('display','block');
          $(".checking-radio-panel-of-lpanel2-class").html(event.lpanel_radio_panel);
          $("#lpanel-wish-price-id").html(event.show_lpanel_name_price);
          $("#lpanel-hide-radio-btn-panel-price-id").val(event.new_price);
          var second_price = parseInt(event.show_lpanel_name_price);
          var first_price = parseInt($("#sixth-panel-price-hidden-id").val());
          var total_price = first_price + second_price;
          $("#seventh-total-price-panel-id").html(total_price);
          $("#seventh-panel-price-hidden-id").val(total_price);
        }
        else
        {
          $(".pick-lpanel-no-type-new").attr('checked','checked');
          $("#lpanel_answer_hidden_id").val("no");
          $("#lpanel-wish-price-id").html('0');
          $("#lpanel-hide-radio-btn-panel-price-id").val('0');
          $(".checking-radio-panel-of-lpanel2-class").css('display','none');
          $("#seventh-total-price-panel-id").html($("#sixth-panel-price-hidden-id").val());
          $("#seventh-panel-price-hidden-id").val($("#sixth-panel-price-hidden-id").val());
        }


        $("#final-product-width").html(event.width_data3);
        $("#final-product-length").html(event.height_data3);
        $("#final-product-post-length").html(event.length_data3);
        $("#final-product-overhead").html(event.overhead_data3);
        $(".final-product-img-final-class").html(event.final_prod_img3);
        $(".last-footprint-img-class").html(event.final_footprint_img3);
        $("#final-product-mount").html(event.mount_new_panel_type);
        $("#final-product-canopy").html(event.canopy_new_panel_type);
        $("#final-product-lpanel").html(event.final_new_lpanel_type);
        $("#final-product-total-price-id").html(event.final_home_price_due);

      }, error: function(event){

      }
    })
  }
</script>
@else
<script>
  $(".master-post-div-panel-class").css("display","none");
</script>
@endif
<script>
function submit_Send_mail_fx()
            {
                var uname = $("#send-form-name-id").val();
                var uemail = $("#send-form-email-id").val();
                var ucomment = $("#send-form-comment-id").val();

                if(uname == "")
                {
                    error_pass_alert_show_msg("Please enter a name");
                }
                else if(uemail == "")
                {
                    error_pass_alert_show_msg("Please enter a email");
                }
                else if(ucomment == "")
                {
                    error_pass_alert_show_msg("Please enter a comment");
                }
                else
                {
                    $.ajax({
                        url: "{{ route('satirtha.send-my-mail') }}",
                        type: "GET",
                        data: {uname: uname, uemail: uemail, ucomment: ucomment},
                        dataType: "json",
                        success: function(event)
                        {
                            if(event == "success"){
                                success_pass_alert_show_msg("Successfully send mail");
                            }else if(event == "error"){
                                error_pass_alert_show_msg("Someting wrong ! try again later");
                            }
                        }
                    })
                }
            }

// master width
function master_width_fx()
{
  $.ajax({
    url: "{{ route('satirtha.choose-master-width') }}",
    type: "GET",
    dataType: "json",
    success: function(event){
      $("#master-home-width-id").html(event);
    }, error: function(event){

    }
  })
}
// master height
function master_height_fx()
{
  $.ajax({
    url: "{{ route('satirtha.choose-master-height') }}",
    type: "GET",
    dataType: "json",
    success: function(event){
      $("#master-home-height-id").html(event);
    }, error: function(event){

    }
  })
}
// master posts
function master_post_fx()
{
  var master_width_name = $("#master-home-width-id").val();
  var master_height_name = $("#master-home-height-id").val();
  $.ajax({
    url: "{{ route('satirtha.choose-master-post') }}",
    type: "GET",
    data: {master_width_name: master_width_name, master_height_name: master_height_name },
    dataType: "json",
    success: function(event){
      $("#master-home-post-id").html(event);
    }, error: function(event){

    }
  })
}
// onchange master width
function master_home_width_fx()
{
  $("#pick_footprint_hide_data_change_panel").val(1);
  var master_width = $("#master-home-width-id").val();
  var master_height = $("#master-home-height-id").val();
  var master_post = $("#master-home-post-id").val();
  if(master_width == "")
  {
    $("#master-new-combine-width-id").html("");
    master_post_fx();
    $("#master-panel-price-id").html("0");
    $("#first-page-price-hidden-id").val(0);
    $("#master-img-panel-page1-id").html('');
    $(".master-post-div-panel-class").css("display","none");
  }
  else
  {
    if(master_width != "" && master_height != "" && master_post != "")
    {
      change_master_post_fx();
      master_post_fx();
    }
    else if(master_width != "" && master_height != "")
    {
      $(".master-post-div-panel-class").css("display","block");
      master_post_fx();
    }
    $.ajax({
      url: "{{ route('satirtha.change-master-width') }}",
      type: "GET",
      data: {id: master_width},
      dataType: 'json',
      success: function(event){
        $("#master-new-combine-width-id").html(event);
      }, error: function(event){

      }
    });
  }
}

// 
function master_home_height_fx()
{
  $("#pick_footprint_hide_data_change_panel").val(1);
  var master_width = $("#master-home-width-id").val();
  var master_height = $("#master-home-height-id").val();
  var master_post = $("#master-home-post-id").val();
  if(master_height == "")
  {
    $("#master-new-combine-height-id").html("");
    master_post_fx();
    $("#master-img-panel-page1-id").html('');
    $("#master-panel-price-id").html("0");
    $("#first-page-price-hidden-id").val(0);
    $(".master-post-div-panel-class").css("display","none");
  }
  else
  {
    if(master_width != "" && master_height != "" && master_post != "")
    {
      change_master_post_fx();
      master_post_fx();
    }
    else if(master_width != "" && master_height != "")
    {
      $(".master-post-div-panel-class").css("display","block");
      master_post_fx();
    }
    $.ajax({
      url: "{{ route('satirtha.change-master-height') }}",
      type: "GET",
      data: {id: master_height},
      dataType: 'json',
      success: function(event){
        $("#master-new-combine-height-id").html(event);
      }, error: function(event){

      }
    });
  }
}
// change master posts
function change_master_post_fx()
{
  $("#pick_footprint_hide_data_change_panel").val(1);
  var master_width = $("#master-home-width-id").val();
  var master_height = $("#master-home-height-id").val();
  var master_post = $("#master-home-post-id").val();
  if(master_post == "")
  {
    $("#master-panel-price-id").html("0");
    $("#first-page-price-hidden-id").val(0);
    $("#master-img-panel-page1-id").html('');
    $("#master-panel-price-id").html("0");
  }
  else
  {
    $.ajax({
      url: "{{ route('satirtha.choose-master-post-wish-price-frame') }}",
      type: "GET",
      data: {master_width: master_width, master_height: master_height, master_post: master_post},
      dataType: "json",
      success: function(event){
        $("#master-panel-price-id").html(event.master_price);
        $("#first-page-price-hidden-id").val(event.master_price);
        $("#master-img-panel-page1-id").html(event.master_img);
      }, error: function(event){
        
      }
    });
  }
}

// click to next (1st to 2nd)
$("#first-page-to-next-id").click(function(){
  var checking_data1 = $("#pick_footprint_hide_data_change_panel").val();
  var master_width = $("#master-home-width-id").val();
  var master_height = $("#master-home-height-id").val();
  var master_post = $("#master-home-post-id").val();
  var second_page_store = $("#ladder-overhead-datas-show-id").val();

  if(master_width ==  "")
  {
    error_pass_alert_show_msg("Please choose a width");
  }
  else if(master_height ==  "")
  {
    error_pass_alert_show_msg("Please choose a length");
  }
  else if(master_post ==  "")
  {
    error_pass_alert_show_msg("Please choose posts");
  }
  else
  {
    current_fs = $(this).parent();
    next_fs = $(this).parent().next();

    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
    step: function(now) {
    // for making fielset appear animation
    opacity = 1 - now;

    current_fs.css({
    'display': 'none',
    'position': 'relative'
    });
    next_fs.css({'opacity': opacity});
    },
    duration: 600
    });

    if(checking_data1 == "1")
    {
      loading_second_page_data_fx();
    }
    
  }
  
});


// second page
function loading_second_page_data_fx()
{
    $("#pick_footprint_hide_data_change_panel").val(0);
    var master_width = $("#master-home-width-id").val();
    var master_height = $("#master-home-height-id").val();
    var master_post = $("#master-home-post-id").val();
    $.ajax({
      url: "{{ route('satirtha.show-second-page-data') }}",
      type: "GET",
      data: {master_width: master_width, master_height: master_height, master_post: master_post},
      dataType: "json",
      success: function(event){
        $("#ladder-overhead-datas-show-id").html(event.overhead_types);
        var first_price = $("#first-page-price-hidden-id").val();
        var second_price = parseInt(first_price);
        $("#second-page-price-hidden-id").val(second_price);
        $("#second-price-panel-id").html(second_price);
      }, error: function(event){
        
      }
    });
}

function overhead_shades2_change_fx()
{
    $("#pick_overhead_shades_hide_data_change_panel").val(1);
    var first_price = $("#first-page-price-hidden-id").val();
    var overhead_val = $("#ladder-overhead-datas-show-id").val();
    if(overhead_val == "")
    {
      
      $("#second-image-panel-id").html("");
      var second_price = parseInt(first_price);
      $("#second-price-panel-id").html(second_price);
      $("#second-page-price-hidden-id").val(second_price);
    }
    else
    {
        var master_width = $("#master-home-width-id").val();
      var master_height = $("#master-home-height-id").val();
      var master_post = $("#master-home-post-id").val();
      $.ajax({
        url: "{{ route('satirtha.choose-second-page-data') }}",
        type: "GET",
        data: {id: overhead_val, master_width: master_width, master_height: master_height, master_post: master_post},
        dataType: "json",
        success: function(event){
          var second_price = parseInt(first_price) + parseInt(event.overhead_price);
          $("#second-page-price-hidden-id").val(second_price);
          $("#second-image-panel-id").html(event.overhead_img);
          $("#second-price-panel-id").html(second_price);
        }, error: function(event){
          
        }
      });
    }
}

// click next btn (2nd to 3rd page)
$("#second-page-to-next-id").click(function(){
  var second_page_store = $("#ladder-overhead-datas-show-id").val();

  if(second_page_store ==  "")
  {
    error_pass_alert_show_msg("Please choose a ladder spacing type");
  }
  else
  {
    current_fs = $(this).parent();
    next_fs = $(this).parent().next();

    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
    step: function(now) {
    // for making fielset appear animation
    opacity = 1 - now;

    current_fs.css({
    'display': 'none',
    'position': 'relative'
    });
    next_fs.css({'opacity': opacity});
    },
    duration: 600
    });

    
      video3Dfx();

  }
})


// end of second page
// start of third page
function video3Dfx()
{
  var master_width = $("#master-home-width-id").val();
  var master_height = $("#master-home-height-id").val();
  var master_post = $("#master-home-post-id").val();
  var overhead_val = $("#ladder-overhead-datas-show-id").val();
  

  $.ajax({
    url: "{{ route('satirtha.show-third-page-data') }}",
    type: "GET",
    data: {master_width: master_width, master_height: master_height, master_post: master_post, overhead_val: overhead_val},
    dataType: "json",
    success: function(event){
      $("#new-custom-third-val-id").find("#3dviewerplayer").attr('src',event);
    }, error: function(event){

    }
  });
}
// click next btn (3nd to 4th page)
$("#third-page-to-next-id").click(function(){
    var fourth_page_data = $("#fourth-page-post-length-id").val(); 

    current_fs = $(this).parent();
    next_fs = $(this).parent().next();

    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
    step: function(now) {
    // for making fielset appear animation
    opacity = 1 - now;

    current_fs.css({
    'display': 'none',
    'position': 'relative'
    });
    next_fs.css({'opacity': opacity});
    },
    duration: 600
    });

    if($("#pick_overhead_shades_hide_data_change_panel").val() == "1")
    {
      loading_fourth_page_data_fx();
    }
})

// end of third page

// start fourth page
function loading_fourth_page_data_fx()
{
  $("#pick_overhead_shades_hide_data_change_panel").val(0);

  var master_width = $("#master-home-width-id").val();
  var master_height = $("#master-home-height-id").val();
  var master_post = $("#master-home-post-id").val();
  var second_page_store = $("#ladder-overhead-datas-show-id").val();

  var price_range = $("#second-page-price-hidden-id").val();
  $.ajax({
    url: "{{ route('satirtha.show-fourth-page-data') }}",
    type: "GET",
    data: {master_width: master_width, master_height: master_height, master_post: master_post, second_page_store: second_page_store},
    dataType: "json",
    success: function(event){
      $("#fourth-page-post-length-id").html(event);
      $("#fourth-page-price-hidden-id").html(price_range);
      $("#fourth-total-price-panel-id").html(price_range);
    }, error: function(event){

    }
  })
}

function choose_fourth_page_data_fx4()
{
  $("#pick_post_length_hide_data_change_panel").val(1);
  var price_range = $("#second-page-price-hidden-id").val();
  var first_step_price = parseInt(price_range);
  var fourth_data = $("#fourth-page-post-length-id").val();

  if(fourth_data == "" || fourth_data == null)
  {
    $("#fourth-price-panel-id").html(0);
    $("#fourth-total-price-panel-id").html(first_step_price);
    $("#fourth-page-price-hidden-id").val(first_step_price);
    $("#fourth-img-panel-view-id").html('');
  }
  else
  {
    var master_width = $("#master-home-width-id").val();
    var master_height = $("#master-home-height-id").val();
    var master_post = $("#master-home-post-id").val();
    var overhead_val = $("#ladder-overhead-datas-show-id").val();
    $.ajax({
      url: "{{ route('satirtha.choose-fourth-page-data') }}",
      type: "GET",
      data: {id: fourth_data, master_width: master_width, master_height: master_height, master_post: master_post, overhead_val: overhead_val},
      dataType: "json",
      success: function(event){
        $("#fourth-price-panel-id").html(event.fourth_price);
        var second_price = parseInt(event.fourth_price);
        $("#fourth-img-panel-view-id").html(event.fourth_img);

        var total_price = parseInt(second_price) + parseInt(first_step_price);
        $("#fourth-total-price-panel-id").html(total_price);
        $("#fourth-page-price-hidden-id").val(total_price);
      }, error: function(event){

      }
    });
  }
}

// click next btn (4th to 5th page)
$("#fourth-page-to-next-id").click(function(){
  var fourth_page_store = $("#fourth-page-post-length-id").val();
  var fifth_price_val = $("#fifth-page-price-hidden-id").val();

  if(fourth_page_store ==  "")
  {
    error_pass_alert_show_msg("Please choose a post length");
  }
  else
  {
    current_fs = $(this).parent();
    next_fs = $(this).parent().next();

    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
    step: function(now) {
    // for making fielset appear animation
    opacity = 1 - now;

    current_fs.css({
    'display': 'none',
    'position': 'relative'
    });
    next_fs.css({'opacity': opacity});
    },
    duration: 600
    });

    if($("#pick_post_length_hide_data_change_panel").val() == "1")
    {
      load_fifth_page_fx5();
    }
    
  }
})

// end of fourth page

// fifth page
function load_fifth_page_fx5()
{
  var master_width = $("#master-home-width-id").val();
  var master_height = $("#master-home-height-id").val();
  var master_post = $("#master-home-post-id").val();
  var second_page_store = $("#ladder-overhead-datas-show-id").val();
  var post_length_data = $("#fourth-page-post-length-id").val();


  
  $.ajax({
    url: "{{ route('satirtha.show-fifth-page-data') }}",
    type: "GET",
    data: { master_width: master_width, master_height: master_height, master_post: master_post, second_page_store: second_page_store, post_length_data_val: post_length_data },
    dataType: "json",
    success: function(event){
      $("#pick-slap-mount-panel-load-id").html(event);
      var fourth_price = parseInt($("#fourth-page-price-hidden-id").val());
      $("#fifth-page-price-hidden-id").val(fourth_price);
      $("#fifth-total-price-panel-id").html(fourth_price);
    }, error: function(event){
      
    }
  });

  $("#pick_post_length_hide_data_change_panel").val(0);
}

function load_fifth_page_fx5_show_view()
{
  var master_width = $("#master-home-width-id").val();
  var master_height = $("#master-home-height-id").val();
  var master_post = $("#master-home-post-id").val();
  var second_page_store = $("#ladder-overhead-datas-show-id").val();
  var post_length_data = $("#fourth-page-post-length-id").val();
  $.ajax({
    url: "{{ route('satirtha.show-fifth-page-data') }}",
    type: "GET",
    data: { master_width: master_width, master_height: master_height, master_post: master_post, second_page_store: second_page_store, post_length_data_val: post_length_data },
    dataType: "json",
    success: function(event){
      $("#pick-slap-mount-panel-load-id").html(event);
    }, error: function(event){
      
    }
  })
}


$('.checking-radio-panel-of-slap-class input:radio').change(function() {
   if( $(this).val() == "yes")
   {
      $("#mount_answer_hidden_id").val("yes");
      $(".pick-slap-select-panel-class").css('display','block');
      load_fifth_page_fx5_show_view();
   }
   else if( $(this).val() == "no")
   {
      $("#mount_answer_hidden_id").val("no");
      $(".pick-slap-select-panel-class").css('display','none');
      var fourth_price = parseInt($("#fourth-page-price-hidden-id").val());
      $("#fifth-page-price-hidden-id").val(fourth_price);
      $("#fifth-total-price-panel-id").html(fourth_price);
      $("#fifth-price-panel-id").html('0');  
      $("#mount-hidden-panel-price-new-id").val('0');
   }
});

function pick_slap_types_fx5()
{
  var pick_slap_var = $("#pick-slap-mount-panel-load-id").val();
  if(pick_slap_var == "" || pick_slap_var == null)
  {
      var fourth_price = parseInt($("#fourth-page-price-hidden-id").val());
      
      $("#fifth-page-price-hidden-id").val(fourth_price);
      $("#fifth-total-price-panel-id").html(fourth_price);  
      $("#fifth-price-panel-id").html('0');  
      $("#mount-hidden-panel-price-new-id").val('0');

  }
  else
  {
        var step1_price = parseInt($("#fourth-page-price-hidden-id").val());
        var step2_price = parseInt($("#pick-slap-mount-panel-load-id").val());
        var main_step3_price = step1_price + step2_price;
        $("#fifth-page-price-hidden-id").val(main_step3_price);
        $("#fifth-total-price-panel-id").html(main_step3_price); 
        $("#fifth-price-panel-id").html(step2_price);  
        $("#mount-hidden-panel-price-new-id").val(step2_price); 
  }
}

// page click btn (5th to 6th)
$("#fifth-page-to-next-id").click(function(){
  var check_radio_val = $('.checking-radio-panel-of-slap-class input[type=radio]:checked').val();
  
  

  if(check_radio_val ==  "" || check_radio_val ==  null || check_radio_val ==  "undefined")
  {
    current_fs = $(this).parent();
    next_fs = $(this).parent().next();

    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
    step: function(now) {
    // for making fielset appear animation
    opacity = 1 - now;

    current_fs.css({
    'display': 'none',
    'position': 'relative'
    });
    next_fs.css({'opacity': opacity});
    },
    duration: 600
    });

  }
  else if(check_radio_val ==  "yes" || check_radio_val ==  "no")
  {
    if(check_radio_val == "yes")
    {
      var pick_slap_val = $("#pick-slap-mount-panel-load-id").val();
      if(pick_slap_val == "" || pick_slap_val == null)
      {
        error_pass_alert_show_msg("Please choose a slap type");
      }
      else
      {
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
        step: function(now) {
        // for making fielset appear animation
        opacity = 1 - now;

        current_fs.css({
        'display': 'none',
        'position': 'relative'
        });
        next_fs.css({'opacity': opacity});
        },
        duration: 600
        });
      }
    }
    else if(check_radio_val == "no")
    {
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
        step: function(now) {
        // for making fielset appear animation
        opacity = 1 - now;

        current_fs.css({
        'display': 'none',
        'position': 'relative'
        });
        next_fs.css({'opacity': opacity});
        },
        duration: 600
        });
    }

    
    
  }

  var my_fifth_panel_price_val = $("#sixth-panel-price-hidden-id").val();
  if(my_fifth_panel_price_val == "" || my_fifth_panel_price_val == null)
  {
    load_sixth_panel_fx6();
  }
})
// end of fifth page

// start sixth page
function load_sixth_panel_fx6()
{
  var master_width = $("#master-home-width-id").val();
  var master_height = $("#master-home-height-id").val();
  var master_post = $("#master-home-post-id").val();
  var second_page_store = $("#ladder-overhead-datas-show-id").val();
  var post_length_data = $("#fourth-page-post-length-id").val();
  $.ajax({
    url: "{{ route('satirtha.show-sixth-page-data') }}",
    type: "GET",
    data: { master_width: master_width, master_height: master_height, master_post: master_post, second_page_store: second_page_store, post_length_data_val: post_length_data },
    dataType: "json",
    success: function(event){
      $(".canopy-note-select-panel-class").html(event);
      $("#sixth-total-price-panel-id").html($("#fifth-page-price-hidden-id").val());
      $("#sixth-panel-price-hidden-id").val($("#fifth-page-price-hidden-id").val());
    }, error: function(event){

    }
  })
}

$('.checking-radio-panel-of-canopy-class input:radio').change(function() {
   if( $(this).val() == "yes")
   {
      $("#canopy_answer_hidden_id").val("yes");
      $(".canopy-note-select-panel-class").css('display','block');
      var first_price = parseInt($("#fifth-page-price-hidden-id").val());
      var second_price = parseInt($("#sixth-pregenerated-price-hidden-val-id").val());
      var total_price = first_price + second_price;
      $("#sixth-total-price-panel-id").html(total_price);
      $("#sixth-panel-price-hidden-id").val(total_price);
      
   }
   else if( $(this).val() == "no")
   {
      $("#canopy_answer_hidden_id").val("no");
      $(".canopy-note-select-panel-class").css('display','none');
      $("#sixth-total-price-panel-id").html($("#fifth-page-price-hidden-id").val());
      $("#sixth-panel-price-hidden-id").val($("#fifth-page-price-hidden-id").val());
   }
});

// page click btn (5th to 6th)
$("#sixth-page-to-next-id").click(function(){
  var check_radio_val = $('.checking-radio-panel-of-canopy-clas input[type=radio]:checked').val();
  

  if(check_radio_val ==  "" || check_radio_val ==  null || check_radio_val ==  "undefined")
  {
    current_fs = $(this).parent();
    next_fs = $(this).parent().next();

    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
    step: function(now) {
    // for making fielset appear animation
    opacity = 1 - now;

    current_fs.css({
    'display': 'none',
    'position': 'relative'
    });
    next_fs.css({'opacity': opacity});
    },
    duration: 600
    });

  }
  else if(check_radio_val ==  "yes" || check_radio_val ==  "no")
  {
    if(check_radio_val == "yes")
    {
      var pick_slap_val = $("#pick-slap-mount-panel-load-id").val();
      if(pick_slap_val == "" || pick_slap_val == null)
      {
        error_pass_alert_show_msg("Please choose a slap type");
      }
      else
      {
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
        step: function(now) {
        // for making fielset appear animation
        opacity = 1 - now;

        current_fs.css({
        'display': 'none',
        'position': 'relative'
        });
        next_fs.css({'opacity': opacity});
        },
        duration: 600
        });
      }
    }
    else if(check_radio_val == "no")
    {
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
        step: function(now) {
        // for making fielset appear animation
        opacity = 1 - now;

        current_fs.css({
        'display': 'none',
        'position': 'relative'
        });
        next_fs.css({'opacity': opacity});
        },
        duration: 600
        });
    }

    
    
  }

  var seven_hide_price = $("#seventh-panel-price-hidden-id").val();
  if(seven_hide_price == "" || seven_hide_price == null)
  {
    loading_seventh_page_datas_fx7();
  }
});
// end of sixth page

// start of seventh page
function loading_seventh_page_datas_fx7()
{
  var master_width = $("#master-home-width-id").val();
  var master_height = $("#master-home-height-id").val();
  var master_post = $("#master-home-post-id").val();
  var second_page_store = $("#ladder-overhead-datas-show-id").val();
  var post_length_data = $("#fourth-page-post-length-id").val();
  $.ajax({
    url: "{{ route('satirtha.show-seventh-page-data') }}",
    type: "GET",
    data: { master_width: master_width, master_height: master_height, master_post: master_post, second_page_store: second_page_store, post_length_data_val: post_length_data },
    dataType: "json",
    success: function(event){
      $(".checking-radio-panel-of-lpanel2-class").html(event.lpanel_radio_panel);
      
      $("#seventh-total-price-panel-id").html($("#sixth-panel-price-hidden-id").val());
      $("#seventh-panel-price-hidden-id").val($("#sixth-panel-price-hidden-id").val());
    }, error: function(event){

    }
  })
}

$('.checking-radio-panel-of-lpanel1-class input:radio').change(function() {
   if( $(this).val() == "yes")
   {  
    var master_width = $("#master-home-width-id").val();
    var master_height = $("#master-home-height-id").val();
    var master_post = $("#master-home-post-id").val();
    var second_page_store = $("#ladder-overhead-datas-show-id").val();
    var post_length_data = $("#fourth-page-post-length-id").val();
     $("#lpanel_answer_hidden_id").val("yes");
      $.ajax({
        url: "{{ route('satirtha.show-seventh-page-data') }}",
        type: "GET",
        data: { master_width: master_width, master_height: master_height, master_post: master_post, second_page_store: second_page_store, post_length_data_val: post_length_data },
        dataType: "json",
        success: function(event){
          $(".checking-radio-panel-of-lpanel2-class").html(event.lpanel_radio_panel);
          $("#lpanel-wish-price-id").html(event.new_price);
          $("#lpanel-hide-radio-btn-panel-price-id").val(event.new_price);
          var second_price = parseInt(event.new_price);
          var first_price = parseInt($("#sixth-panel-price-hidden-id").val());
          var total_price = first_price + second_price;
          $("#seventh-total-price-panel-id").html(total_price);
          $("#seventh-panel-price-hidden-id").val(total_price);
        }, error: function(event){

        }
      })
      $(".checking-radio-panel-of-lpanel2-class").css('display','block');
   }
   else if( $(this).val() == "no")
   {
    $("#lpanel_answer_hidden_id").val("no");
      $("#lpanel-wish-price-id").html('0');
      $("#lpanel-hide-radio-btn-panel-price-id").val('0');
      $(".checking-radio-panel-of-lpanel2-class").css('display','none');
      $("#seventh-total-price-panel-id").html($("#sixth-panel-price-hidden-id").val());
      $("#seventh-panel-price-hidden-id").val($("#sixth-panel-price-hidden-id").val());
   }
});

function my_seveth_click(main_price)
{
  var second_price = parseInt(main_price);
  var first_price = parseInt($("#sixth-panel-price-hidden-id").val());
  var total_price = first_price + second_price;
  $("#lpanel-wish-price-id").html(main_price);
  $("#lpanel-hide-radio-btn-panel-price-id").html(main_price);
  $("#seventh-total-price-panel-id").html(total_price);
  $("#seventh-panel-price-hidden-id").val(total_price);
}


// click next btn (7th to 8th page)
$("#seventh-page-to-next-id").click(function(){
 
    current_fs = $(this).parent();
    next_fs = $(this).parent().next();

    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
    step: function(now) {
    // for making fielset appear animation
    opacity = 1 - now;

    current_fs.css({
    'display': 'none',
    'position': 'relative'
    });
    next_fs.css({'opacity': opacity});
    },
    duration: 600
    });

    final_product_img_fx();
})

// end of seventh page

// final product eighth page
function final_product_img_fx()
{
  var master_width = $("#master-home-width-id").val();
  var master_height = $("#master-home-height-id").val();
  var master_post = $("#master-home-post-id").val();
  var overhead_type_val = $("#ladder-overhead-datas-show-id").val();
  var post_length_val = $("#fourth-page-post-length-id").val();
  var slap_panel_val_type = $("#mount_answer_hidden_id").val();

  // alert(master_width+" "+master_height+" "+master_post+" "+overhead_type_val+" "+post_length_val+" "+slap_panel_val_type);
 
  if(slap_panel_val_type == "no" || slap_panel_val_type ==  "" || slap_panel_val_type ==  null || slap_panel_val_type ==  "undefined")
  {
    var slap_new_details = "no";
  }
  else if(slap_panel_val_type == "yes")
  {
    var slap_new_details = "yes";
  }
  
  var canopy_val_type = $("#canopy_answer_hidden_id").val();
  if(canopy_val_type == "no" || canopy_val_type ==  "" || canopy_val_type ==  null || canopy_val_type ==  "undefined")
  {
    var canopy_val_details = "no";
  }
  else if(canopy_val_type == "yes")
  {
    var canopy_val_details = "yes";
  }
  
  var lpanel_val_type = $(".checking-radio-panel-of-lpanel1-class input[type=radio]:checked").val();
  if(lpanel_val_type == "no" || lpanel_val_type ==  "" || lpanel_val_type ==  null || lpanel_val_type ==  "undefined")
  {
    var lpanel_val_details = "no";
  }
  else if(lpanel_val_type == "yes")
  {
    var lpanel_val_details = "yes";
  }
  $("#final-product-total-price-id").html($("#seventh-panel-price-hidden-id").val());
  
  $.ajax({
    url: "{{ route('satirtha.show-final-page-data') }}",
    type: "GET",
    data: {master_width: master_width, master_height: master_height, master_post: master_post, overhead_type_val: overhead_type_val, post_length_val: post_length_val },
    dataType: "json",
    success: function(event){
      $("#final-product-width").html(event.width_data);
      $("#final-product-length").html(event.height_data);
      $("#final-product-post-length").html(event.length_data);
      $("#final-product-overhead").html(event.overhead_data);
      $(".final-product-img-final-class").html(event.final_prod_img);
      $(".last-footprint-img-class").html(event.final_footprint_img);
      $("#final-product-mount").html(slap_new_details);
      $("#final-product-canopy").html(canopy_val_details);
      $("#final-product-lpanel").html($("#lpanel_answer_hidden_id").val());

      insert_before_checkout_product();
    }, error: function(event){
      
    }
  })
 
}

$("#last-getting-next-id").click(function(){

    current_fs = $(this).parent();
    next_fs = $(this).parent().next();

    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
    step: function(now) {
    // for making fielset appear animation
    opacity = 1 - now;

    current_fs.css({
    'display': 'none',
    'position': 'relative'
    });
    next_fs.css({'opacity': opacity});
    },
    duration: 600
    });

})
// end if final product eigth page

// data insert before checking out
function insert_before_checkout_product()
{
  var master_width = $("#master-home-width-id").val();
  var master_height = $("#master-home-height-id").val();
  var master_post = $("#master-home-post-id").val();
  var overhead_type_val = $("#ladder-overhead-datas-show-id").val();
  var post_length_val = $("#fourth-page-post-length-id").val();
  var slap_panel_val_type = $("#mount_answer_hidden_id").val();
 
  if(slap_panel_val_type == "no" || slap_panel_val_type ==  "" || slap_panel_val_type ==  null || slap_panel_val_type ==  "undefined")
  {
    var slap_new_details = "no";
    var mount_data = "";
  }
  else if(slap_panel_val_type == "yes")
  {
    var slap_new_details = "yes";
    var mount_data = $("#pick-slap-mount-panel-load-id").val();
  }
  
  var canopy_val_type = $("#canopy_answer_hidden_id").val();
  if(canopy_val_type == "no" || canopy_val_type ==  "" || canopy_val_type ==  null || canopy_val_type ==  "undefined")
  {
    var canopy_val_details = "no";
  }
  else if(canopy_val_type == "yes")
  {
    var canopy_val_details = "yes";
  }
  
  var lpanel_val_type = $("#lpanel_answer_hidden_id").val();
  if(lpanel_val_type == "no" || lpanel_val_type ==  "" || lpanel_val_type ==  null || lpanel_val_type ==  "undefined")
  {
    var lpanel_val_details = "no";
    var lpanel_main_data = "";
  }
  else if(lpanel_val_type == "yes")
  {
    var lpanel_val_details = "yes";
    var lpanel_main_data = $("#lpanel-hide-radio-btn-panel-price-id").val();
  }

  var total_price = $("#seventh-panel-price-hidden-id").val();

  var mount_panel_hide_price = $("#mount-hidden-panel-price-new-id").val();

  var canopy_price = $("#sixth-pregenerated-price-hidden-val-id").val();

  $.ajax({
    url : "{{ route('satirtha.BeforeCheckoutFinalProduct') }}",
    type: "GET",
    data: {master_width: master_width, master_height: master_height, master_post: master_post, overhead_type_val: overhead_type_val, post_length_val: post_length_val, slap_mount_type: slap_new_details, mount_panel_hide_price: mount_panel_hide_price, canopy_type_data: canopy_val_details, canopy_price: canopy_price, lpanel_val_type: lpanel_val_details, lpanel_main_data: lpanel_main_data, total_price: total_price },
    dataType: "json",
    success: function(event){
      console.log(event);
    }, error: function(event){

    }
  })
}


</script>
@endsection