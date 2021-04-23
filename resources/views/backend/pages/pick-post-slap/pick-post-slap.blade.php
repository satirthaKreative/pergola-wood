@extends('backend.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Pick Post Slap</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Pick Post Slap</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- /.row -->
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
        <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Pick Post Slap Table</h3>
              <span class="float-right" id="piller-state-id"><a href="javascript: ;" onclick="change_piller_table_minus_state()" class="btn btn-danger btn-sm"><i class="fa fa-minus"></i></a></span><span class="float-right"><a class="btn btn-danger btn-sm" href="#edit-pick-overhead-shades-form-head-id" id="add-master-height-id" style="margin-right: 10px;">Add Post Length</a></span>
            </div>
            <!-- /.card-header -->
            <div style="padding: 10px">
            <div class="card-body table-responsive scroll-demo-table p-0">
              <table class="table table-hover text-nowrap" id="show-piller-post-id">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Slap Name</th>
                    <th>Slap Price</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="campaign-tbl-id">
                  <tr>
                    <td colspan="5"><center class="text-info"><i class="fa fa-spinner"></i> Loading data's</center></td>
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
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title" id="edit-pick-overhead-shades-form-head-id">Pick Post Slap (Add Form)</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" enctype="multipart/form-data" id="admin-submit-pick-overhead-shades-form-id" method="POST" action="{{ route('admin.submit-pick-post-slap') }}">
            @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="ladder-spacing-id">Post Slap Name *</label>
                  <input type="text" required class="form-control" name="post_length" id="ladder-spacing-id" placeholder="Enter post slap name">
                </div>
                <div class="form-group">
                  <label for="ladder-spacing-price-id">Post Slap Price *</label>
                  <input type="number" required class="form-control" name="post_length_price" id="ladder-spacing-price-id" placeholder="Enter post slap price">
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
      
    </div><!-- /.container-fluid -->
</section>
  <!-- /.content -->
@endsection
@section('adminjsContent')
<script>

    $(function(){
        show_piller_posts_table();
        $("#add-master-height-id").click(function(){
          $("#edit-pick-overhead-shades-form-head-id").html("Pick Post Slap (Add Form)");
          $("#admin-submit-pick-overhead-shades-form-id").find('#ladder-spacing-id').val("");
          $("#admin-submit-pick-overhead-shades-form-id").find('#ladder-spacing-price-id').val("");
          $("#admin-submit-pick-overhead-shades-form-id").attr("action","{{ route('admin.submit-pick-post-slap') }}");
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
            url: "{{ route('admin.show-pick-post-slap') }}",
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
            url: "{{ route('admin.pick-post-slap-action-change') }}",
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

    function make_del_change(id)
    {
      var x = confirm("Are you sure you want to delete?");
      if (x)
      {
        $.ajax({
            url: "{{ route('admin.pick-post-slap-action-del') }}",
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
        var main_ul_window = window_lc+"/admin/add-pick-post-slap#edit-pick-overhead-shades-form-head-id";
        window.location.href=main_ul_window;
        var url_id= "{{ url('admin/admin-pick-post-slap-edit') }}"+"/"+id;
        $.ajax({
            url: "{{ route('admin.pick-post-slap-action-view-edit') }}",
            type: "GET",
            data: {id: id},
            dataType: "json",
            success: function(event){
                $("#edit-pick-overhead-shades-form-head-id").html("Pick Post Slap (Edit Form)");
                $("#admin-submit-pick-overhead-shades-form-id").find('#ladder-spacing-id').val(event.name_type);
                $("#admin-submit-pick-overhead-shades-form-id").find('#ladder-spacing-price-id').val(event.price_details);
                $("#admin-submit-pick-overhead-shades-form-id").attr("action",url_id);
            }, error: function(event){

            }
        })
    }
</script>
@endsection