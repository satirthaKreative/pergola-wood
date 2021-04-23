@extends('backend.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Pick a Footprint (outside post to post)</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Pick a Footprint</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Pick a Footprint (outside post to post)</h3>
              <span class="float-right"><a href="{{ route('admin.view-pick-a-footprint') }}" class="btn btn-danger btn-sm">View Pick a Footprint</a></span>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" enctype="multipart/form-data" method="POST" action="{{ route('admin.insert-pick-a-footprint') }}">
            @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="width-in-feet-master">Width (In Feet *)</label>
                  <select onchange=width_in_feet_master_fx() class="form-control" name="width_in_feet_master" id="width-in-feet-master" placeholder="">
                    <option value="">Choose A Master Width</option>
                  </select>
                </div>
                <div  id="pick-up-footprint-height-body-id">

                </div>
                <div  id="pick-up-footprint-post-body-id">

                </div>
                <div  id="pick-up-footprint-img-body-id">

                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary" id="pickup-submit-btn">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.card -->

        </div>
        <!--/.col (left) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
  <!-- /.content -->
@endsection
@section('adminjsContent')
<script>
    $(function(){
      $("#pickup-submit-btn").prop('disabled', true);

      // loading width
      loading_time_width_fx();
    })
    // first time load
    function loading_time_width_fx()
    {
      $.ajax({
        url: "{{ route('admin.show-width-pick-a-footprint') }}",
        type: "GET",
        dataType: "json",
        success: function(event){
          $("#width-in-feet-master").html(event);
        }, error: function(event){

        }
      })
    }
    // first time load
    function loading_time_height_fx()
    {
      $.ajax({
        url: "{{ route('admin.show-height-pick-a-footprint') }}",
        type: "GET",
        dataType: "json",
        success: function(event){
          $("#height-in-feet-master").html(event);
        }, error: function(event){

        }
      })
    }
    // width in feet onkeyup change
    function width_in_feet_master_fx()
    {
        if($("#width-in-feet-master").val().length > 2 )
        {

        }
        else if($("#width-in-feet-master").val().length == 1 || $("#width-in-feet-master").val().length == 2)
        {
            if($("#pick-up-footprint-height-body-id .form-group").length > 0)
            {

            }
            else if($("#pick-up-footprint-height-body-id .form-group").length == 0)
            {
                $("#pick-up-footprint-height-body-id").append('<div class="form-group"><label for="height-in-feet-master">Height (In Feet *)</label><select onchange="height_in_feet_master_fx()" class="form-control" name="height_in_feet_master" id="height-in-feet-master" placeholder="Enter Height In Feet Master" required></div>');
                loading_time_height_fx();
            }
            
        }
        else if($("#width-in-feet-master").val().length == 0)
        {
            $("#pick-up-footprint-height-body-id").find(".form-group").remove();
            $("#pick-up-footprint-post-body-id").find(".form-group").remove();
            $("#pick-up-footprint-img-body-id").find(".form-group").remove();
            $("#pickup-submit-btn").prop('disabled', true);
        }
    }

    // height onchange 
    function height_in_feet_master_fx()
    {
        if($("#height-in-feet-master").val().length > 2 )
        {

        }
        else if($("#height-in-feet-master").val().length == 1 || $("#height-in-feet-master").val().length == 2)
        {
            if($("#pick-up-footprint-post-body-id .form-group").length > 0)
            {

            }
            else if($("#pick-up-footprint-post-body-id .form-group").length == 0)
            {
                $("#pick-up-footprint-post-body-id").append('<div class="form-group"><label for="posts-in-feet-master-id">Post *</label><select onchange="posts_in_feet_master_fx()" class="form-control" name="posts_in_feet_master" id="posts-in-feet-master-id" required><option value="">Choose no. of posts</option></select></div>');
                getPostsFx();
            }
            
        }
        else if($("#height-in-feet-master").val().length == 0)
        {
            $("#pick-up-footprint-post-body-id").find(".form-group").remove();
            $("#pick-up-footprint-img-body-id").find(".form-group").remove();
            $("#pickup-submit-btn").prop('disabled', true);
        }
    }

    function getPostsFx()
    {
        $.ajax({
          url: "{{ route('admin.get-posts-in-pick-a-footprint') }}",
          type: "GET",
          dataType: "json",
          success: function(event){
            $("#posts-in-feet-master-id").html(event);
          }, error: function(event){

          }
        })
    }

    function posts_in_feet_master_fx()
    {
      var get_posts_id = $("#posts-in-feet-master-id").val();
      if(get_posts_id == "" || get_posts_id == null)
      {
        var alert_msg = "Please choose a valid posts no.";
        error_pass_alert_show_msg(alert_msg);
        $("#pick-up-footprint-img-body-id").find(".form-group").remove();
      }
      else
      {
        if($("#pick-up-footprint-img-body-id .form-group").length == 0)
        {
          $("#pick-up-footprint-img-body-id").append('<div class="form-group"><label for="img-in-feet-master-id">Image (Optional)</label><input type="file" class="form-control" name="img_in_feet_master" id="img-in-feet-master-id" placeholder="Choose a image"></div><div class="form-group"><label for="price-in-feet-master-id">Price *</label><input type="number"  class="form-control" name="price_in_feet_master" id="price-in-feet-master-id" placeholder="Enter Product Price" required></div>');
          $("#pickup-submit-btn").prop('disabled', false);
        }
        else if($("#pick-up-footprint-img-body-id .form-group").length > 0)
        {

        }
      }
    }
</script>
@endsection