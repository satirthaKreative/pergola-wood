@extends('backend.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>3D View Panel</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">3D View Table</li>
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
              <h3 class="card-title">3D View Table</h3>
              <span class="float-right" id="piller-state-id"><a href="javascript: ;" onclick="change_piller_table_minus_state()" class="btn btn-danger btn-sm"><i class="fa fa-minus"></i></a></span>
              <span class="float-right"><a class="btn btn-danger btn-sm" href="#add-master-height" id="add-master-height-id" style="margin-right: 10px;">Add 3D View Panel</a></span>
            </div>
            <!-- /.card-header -->
            <div style="padding: 10px" id="show-piller-post-id">
            <div class="card-body table-responsive scroll-demo-table p-0">
              <table class="table table-hover text-nowrap" >
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Videos</th>
                    <th>Master Width</th>
                    <th>Master Length</th>
                    <th>No of Posts</th>
                    <th>Overhead Shades</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="campaign-tbl-id">
                  <tr>
                    <td colspan="8"><center class="text-info"><i class="fa fa-spinner"></i> Loading data's</center></td>
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
              <h3 class="card-title" id="add-edit-master-height-id">3D view panel (Add Form)</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" enctype="multipart/form-data" id="add-edit-master-height-action-id" method="POST" action="{{ route('admin.submit-3D-data') }}">
            @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="posts-length-width-id">Master Width</label>
                  <select required class="form-control" name="master_width" id="master-width-id">
                    <option value="">Choose a master width</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="posts-length-width-id">Master Length</label>
                  <select required class="form-control" name="master_length" id="master-height-id">
                    <option value="">Choose a master height</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="post-length-id">No. of posts</label>
                  <select required class="form-control" name="no_of_posts" id="no-of-posts-id">
                    <option value="">Choose no of posts</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="overhead-shades-id">Overhead Shades</label>
                  <select required class="form-control" name="overhead_shades" id="overhead-shades-id">
                    <option value="">Choose a overhead shades type</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="final-product-img-id">3D video upload *</label>
                  <input type="text" required class="form-control" name="final_product_img" id="final-product-img-id" placeholder="Enter 3D link">
                  <div class="pick-overhead-img"></div>
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
        loading_3d_table();
        loading_3d_form();

        $("#add-master-height-id").click(function(){
                $("#add-edit-master-height-id").html("3D view panel (Add Form)");
                loading_3d_form();
          $("#add-edit-master-height-action-id").attr("action","{{ route('admin.submit-3D-data') }}");
          $("#add-edit-master-height-action-id").find('#final-product-img-id').prop("required", true);
          $(".pick-overhead-img").hide();
        });
    })

    // loading 3d table
    function loading_3d_table()
    {
      $.ajax({
        url: "{{ route('admin.get-table-data-for-3D-view') }}",
        type: "GET",
        dataType: "json",
        success: function(event){
            $("#campaign-tbl-id").html(event.show_3d_show);
            $("table").dataTable();
        }, error: function(event){

        }
      })
    }

    // loading 3d form data's
    function loading_3d_form()
    {
        $.ajax({
            url: "{{ route('admin.get-data-for-3D-view') }}",
            type: "GET",
            dataType: "json",
            success: function(event){
              $("#master-width-id").html(event.master_width_query);
              $("#master-height-id").html(event.master_height_query);
              $("#no-of-posts-id").html(event.no_of_piller_options);
              $("#overhead-shades-id").html(event.master_overhead_query);
            }, error: function(event){
                
            }
        })
    }

    // 
    function make_btn_change(state, id)
    {
        $.ajax({
            url: "{{ route('admin.change-action-data-for-3D-view') }}",
            type: "GET",
            data: {state: state, id: id},
            dataType: "json",
            success: function(event){
                if(event == "success")
                {
                    msg = "Admin action successfully applied";
                    success_pass_alert_show_msg(msg);
                    loading_3d_table();
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

    // delete 
    function make_del_change(id)
    {
      var x = confirm("Are you sure you want to delete?");
      if (x)
      {
        $.ajax({
            url: "{{ route('admin.del-action-data-for-3D-view') }}",
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

    
    // edit
    function make_edit_change(id)
    {
        var window_lc = window.origin;
        var main_ul_window = window_lc+"/admin/panel-for-3D-view#add-master-height";
       
        window.location.href=main_ul_window;
        var url_id= "{{ url('admin/edit-action-data-for-3D-view') }}"+"/"+id;
        $.ajax({
            url: "{{ route('admin.edit-view-action-data-for-3D-view') }}",
            type: "GET",
            data: {id: id},
            dataType: "json",
            success: function(event){
                $("#add-edit-master-height-id").html("3D view panel (Edit Form)");

                $("#add-edit-master-height-action-id").attr("action",url_id);
                $("#add-edit-master-height-action-id").find('#final-product-img-id').removeAttr("required");

                $("#master-width-id").html(event.master_width_query);
                $("#master-height-id").html(event.master_height_query);
                $("#no-of-posts-id").html(event.no_of_piller_options);
                $("#overhead-shades-id").html(event.master_overhead_query);
                $("#final-product-img-id").val(event.master_3D_video);

                
            }, error: function(event){

            }
        })
    }

    // minus & plus part
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
</script>
@endsection