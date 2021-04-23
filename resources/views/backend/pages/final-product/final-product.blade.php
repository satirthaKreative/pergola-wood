@extends('backend.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Final Product Image</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Final Product Image</li>
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
        <div class="col-md-12">
        <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Pick Post Length Table</h3>
              <span class="float-right" id="piller-state-id"><a href="javascript: ;" onclick="change_piller_table_minus_state()" class="btn btn-danger btn-sm"><i class="fa fa-minus"></i></a></span>
              <span class="float-right"><a class="btn btn-danger btn-sm" href="#add-master-height" id="add-master-height-id" style="margin-right: 10px;">Add Final Product</a></span>
            </div>
            <!-- /.card-header -->
            <div style="padding: 10px" id="show-piller-post-id">
            <div class="card-body table-responsive scroll-demo-table p-0">
              <table class="table table-hover text-nowrap" >
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Final Product Image</th>
                    <th>Final Footprint Image</th>
                    <th>Combination Types</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="campaign-tbl-id">
                  <tr>
                    <td colspan="6"><center class="text-info"><i class="fa fa-spinner"></i> Loading data's</center></td>
                  </tr>
                </tbody>
              </table>
            </div>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        <!--/.col (left) -->
      </div>
      <!-- /.row -->
      <div class="row">
        <!-- left column -->
        <div class="col-md-6" id="add-master-height">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title" id="add-edit-master-height-id">Final Product Image (Add Form)</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" enctype="multipart/form-data" id="add-edit-master-height-action-id" method="POST" action="{{ route('admin.submit-final-product') }}">
            @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="posts-length-width-id">Combination Panel</label>
                  <select required class="form-control" name="post_length_width" id="combination-panel-id">
                    <option value="">Choose a combination</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="final-product-img-id">Final Product Image *</label>
                  <input type="file" required class="form-control" name="final_product_img" id="final-product-img-id" placeholder="Enter final product image">
                  <div class="pick-overhead-img"></div>
                </div>
                <div class="form-group">
                  <label for="final-product-img-id">Final Footprint Image *</label>
                  <input type="file" required class="form-control" name="final_footprint_img" id="final-footprint-img-id" placeholder="Enter final footprint image">
                  <div class="pick-footprint-img"></div>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
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
        choose_footprint_fx();
        setTimeout(() => {   
            show_piller_posts_table();
        }, 2000);
        $("#add-master-height-id").click(function(){
                $("#add-edit-master-height-id").html("Final Product Image (Add Form)");
                choose_footprint_fx();
          $("#add-edit-master-height-action-id").attr("action","{{ route('admin.submit-final-product') }}");
          $("#add-edit-master-height-action-id").find('#final-product-img-id').prop("required", true);
          $("#add-edit-master-height-action-id").find('#final-footprint-img-id').prop("required", true);
          $(".pick-overhead-img").hide();
          $(".pick-footprint-img").hide();
        });
    })


    function change_piller_table_plus_state()
    {
        $("#piller-state-id").html('<a href="javascript: ;"  onclick="change_piller_table_minus_state()" class="btn btn-danger btn-sm"><i class="fa fa-minus"></i></a>');
        $("#show-piller-post-id").show();
    }

    function change_piller_table_minus_state()
    {
        $("#piller-state-id").html('<a href="javascript: ;"  onclick="change_piller_table_plus_state()" class="btn btn-danger btn-sm"><i class="fa fa-plus"></i></a>');
        $("#show-piller-post-id").hide();
    }



    function show_piller_posts_table()
    {
        $.ajax({
            url: "{{ route('admin.show-final-product') }}",
            type: "GET",
            dataType: "json",
            success: function(event){
                $("#campaign-tbl-id").html(event);
                $("table").dataTable();
            }, error: function(event){

            }
        })
    }

    function make_btn_change(state, id)
    {
        $.ajax({
            url: "{{ route('admin.final-product-action-change') }}",
            type: "GET",
            data: {state: state, id: id},
            dataType: "json",
            success: function(event){
                if(event == "success")
                {
                    msg = "Admin action successfully applied";
                    success_pass_alert_show_msg(msg);
                    show_piller_posts_table();
                }
                else if(event == "error")
                {
                    msg = "Something went wrong! Try again later";
                    error_pass_alert_show_msg(msg);
                }
                else
                {
                    var msg = "Server getting down! Try again later";
                    error_pass_alert_show_msg(msg);
                }
            }, error: function(event){

            }
        })
    }

    // choose footprint
    function choose_footprint_fx()
    {
      $.ajax({
        url: "{{ route('admin.combination-panel-show') }}",
        type: "GET",
        dataType: "JSON",
        success: function(event){
          $("#combination-panel-id").html(event.combination_data);
        }, error: function(event){

        }
      })
    }
    


    // delete & edit & view-edit
    function make_del_change(id)
    {
      var x = confirm("Are you sure you want to delete?");
      if (x)
      {
        $.ajax({
            url: "{{ route('admin.final-product-action-del') }}",
            type: "GET",
            data: {id: id},
            dataType: "json",
            success: function(event){
                if(event == "success")
                {
                    msg = "Delete action successfully applied";
                    success_pass_alert_show_msg(msg);
                    location.reload();
                }
                else if(event == "error")
                {
                    msg = "Something went wrong! Try again later";
                    error_pass_alert_show_msg(msg);
                }
                else
                {
                    var msg = "Server getting down! Try again later";
                    error_pass_alert_show_msg(msg);
                }
            }, error: function(event){

            }
        })
      }
      else
      {

      }
    }


    function make_edit_change(id)
    {
        var window_lc = window.origin;
        var main_ul_window = window_lc+"/admin/add-final-product#add-master-height";
       
        window.location.href=main_ul_window;
        var url_id= "{{ url('admin/admin-final-product-edit') }}"+"/"+id;
        $.ajax({
            url: "{{ route('admin.final-product-action-view-edit') }}",
            type: "GET",
            data: {id: id},
            dataType: "json",
            success: function(event){
                $("#add-edit-master-height-id").html("Final Product Image (Edit Form)");
                $("#add-edit-master-height-action-id").find('#posts-length-width-id').html(event.combination);
                $("#add-edit-master-height-action-id").find('#post-length-id').html(event.post_length);
                $("#add-edit-master-height-action-id").find('#overhead-shades-id').html(event.img_standard);
                $("#add-edit-master-height-action-id").attr("action",url_id);
                $("#add-edit-master-height-action-id").find('#final-product-img-id').removeAttr("required");
                $("#add-edit-master-height-action-id").find('#final-footprint-img-id').removeAttr("required");
                $("#combination-panel-id").html(event.combination_data);
                $(".pick-overhead-img").show();
                $(".pick-overhead-img").html(event.img_file_name);
                $(".pick-footprint-img").show();
                $(".pick-footprint-img").html(event.footprint_file_name);
                
            }, error: function(event){

            }
        })
    }
</script>
@endsection