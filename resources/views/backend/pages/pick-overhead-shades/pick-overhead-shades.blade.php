@extends('backend.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Pick Overhead Shades</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Pick Overhead Shades</li>
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
              <h3 class="card-title">Pick Overhead Shades  </h3>
              <span class="float-right" id="piller-state-id"><a href="javascript: ;" onclick="change_piller_table_minus_state()" class="btn btn-danger btn-sm"><i class="fa fa-minus"></i></a> </span><span class="float-right"><a class="btn btn-danger btn-sm" href="#edit-pick-overhead-shades-form-head-id" id="add-master-height-id" style="margin-right: 10px;">Add Pick Overhead Shades</a></span>
            </div>
            <!-- /.card-header -->
            <div style="padding: 10px">
            <div class="card-body table-responsive scroll-demo-table p-0">
              <table class="table table-hover text-nowrap" id="show-piller-post-id">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Images</th>
                    <th>Combination</th>
                    <th>Types</th>
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
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title" id="edit-pick-overhead-shades-form-head-id">Pick Overhead Shades (Add Form)</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" id="admin-submit-pick-overhead-shades-form-id" enctype="multipart/form-data" method="POST" action="{{ route('admin.submit-pick-overhead-shades') }}">
            @csrf
              <div class="card-body">
              
              <div class="form-group">
                  <label for="ladder-spacing-id">Master Width *</label>
                  <select required class="form-control" name="master_width" id="master-width-id" placeholder="Enter width" onclick="master_width_onchange()">
                    <option value="">Choose master width</option>
                  </select>
              </div>
              <div class="form-group">
                  <label for="ladder-spacing-id">Master Height *</label>
                  <select required class="form-control" name="master_height" id="master-height-id" placeholder="Enter height" onclick="master_width_onchange()">
                    <option value="">Choose master height</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="ladder-spacing-id">Master Posts *</label>
                  <select required class="form-control" name="master_post" id="master-post-id" placeholder="Enter post">
                    <option value="">Choose master posts</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="ladder-spacing-id">Ladder Spacing *</label>
                  <select required class="form-control" name="ladder_spacing" id="ladder-spacing-id" placeholder="Enter ladder spacing">
                    <option value="">Choose ladder spacing</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="ladder-spacing-price-id">Ladder Spacing Price *</label>
                  <input type="number" required class="form-control" name="ladder_spacing_price" id="ladder-spacing-price-id" placeholder="Enter ladder spacing price">
                </div>
                <div class="form-group">
                  <label for="ladder-spacing-price-id">Ladder Spacing Image</label>
                  <input type="file" class="form-control" name="ladder_spacing_file" id="ladder-spacing-file-id" placeholder="Enter ladder spacing image">
                  <div class="pick-overhead-img">

                  </div>
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
        show_piller_posts_table();
        load_overhead_shades_fx();
        $("#add-master-height-id").click(function(){
          $("#edit-pick-overhead-shades-form-head-id").html("Pick Overhead Shades (Add Form)");
          $("#admin-submit-pick-overhead-shades-form-id").find('#ladder-spacing-id').val("");
          $("#admin-submit-pick-overhead-shades-form-id").find('#ladder-spacing-price-id').val("");
          $("#admin-submit-pick-overhead-shades-form-id").find('#ladder-spacing-file-id').val("");
          $("#admin-submit-pick-overhead-shades-form-id").find('#ladder-spacing-file-id').attr("required");
          $("#admin-submit-pick-overhead-shades-form-id").attr("action","{{ route('admin.submit-pick-overhead-shades') }}");
          $(".pick-overhead-img").hide();
        });
    });

    function master_width_onchange()
    {
      var w_id = $("#master-width-id").val();
      var h_id = $("#master-height-id").val();
      if(w_id != "" && w_id != null && h_id != "" && h_id != null)
      {
        $.ajax({
          url: "{{ route('admin.pick-overhead-shades-post-first-load') }}",
          type: "GET",
          data: {w_id: w_id, h_id: h_id},
          dataType: 'json',
          success: function(event){
            $("#master-post-id").html(event.master_posts);
          }, error: function(event){

          }
        });
      }
      else
      {
        $("#master-post-id").html('<option value="">Choose master posts</option>');
      }
      
    }


    function load_overhead_shades_fx()
    {
      $.ajax({
        url: "{{ route('admin.pick-overhead-shades-height-width-first-load') }}",
        type: "GET",
        dataType: "json",
        success: function(event){
          $("#master-height-id").html(event.master_height);
          $("#master-width-id").html(event.master_width);
          $("#ladder-spacing-id").html(event.master_overhead);
        }, error: function(event){

        }
      })
    }


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
            url: "{{ route('admin.show-pick-overhead-shades') }}",
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
            url: "{{ route('admin.change-action-pick-overhead-shades') }}",
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
            url: "{{ route('admin.del-action-pick-overhead-shades') }}",
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
        var main_ul_window = window_lc+"/admin/add-pick-overhead-shades#edit-pick-overhead-shades-form-head-id";
        console.log(main_ul_window);
        window.location.href=main_ul_window;
        var url_id= "{{ url('admin/admin-pick-overhead-shades-edit') }}"+"/"+id;
        $.ajax({
            url: "{{ route('admin.view-edit-action-pick-overhead-shades') }}",
            type: "GET",
            data: {id: id},
            dataType: "json",
            success: function(event){
                $("#edit-pick-overhead-shades-form-head-id").html("Pick Overhead Shades (Edit Form)");
                $("#admin-submit-pick-overhead-shades-form-id").find('#ladder-spacing-id').val(event.name_type);
                $("#admin-submit-pick-overhead-shades-form-id").find('#ladder-spacing-price-id').val(event.price_details);
                $("#admin-submit-pick-overhead-shades-form-id").find('#ladder-spacing-file-id').removeAttr("required");
                $("#master-height-id").html(event.master_height);
                $("#master-width-id").html(event.master_width);
                $("#ladder-spacing-id").html(event.master_overhead);
                $("#master-post-id").html(event.master_posts);
                $(".pick-overhead-img").show();
                $(".pick-overhead-img").html(event.img_details);
                $("#admin-submit-pick-overhead-shades-form-id").attr("action",url_id);
            }, error: function(event){

            }
        })
    }
</script>
@endsection