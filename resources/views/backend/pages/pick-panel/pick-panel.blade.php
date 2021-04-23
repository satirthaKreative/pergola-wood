@extends('backend.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Pick Louvered Panel</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Pick Louvered Panel</li>
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
        <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Pick Louvered Panel Table</h3>
              <span class="float-right" id="piller-state-id"><a href="javascript: ;" onclick="change_piller_table_minus_state()" class="btn btn-danger btn-sm"><i class="fa fa-minus"></i></a></span>
              <span class="float-right"><a class="btn btn-danger btn-sm" href="#add-master-height" id="add-master-height-id" style="margin-right: 10px;">Add Pick Louvered Panel</a></span>
            </div>
            <!-- /.card-header -->
            <div style="padding: 10px">
            <div class="card-body table-responsive scroll-demo-table p-0">
              <table class="table table-hover text-nowrap" id="show-piller-post-id">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
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
        <div class="col-md-6"  id="add-master-height">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title" id="add-edit-master-height-id">Pick Louvered Panel (Add Form)</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" enctype="multipart/form-data" id="add-edit-master-height-action-id" method="POST" action="{{ route('admin.submit-pick-panel') }}">
            @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="ladder-spacing-id">Louvered Panels Name *</label>
                  <textarea required class="form-control" name="l_panel_name" id="ladder-spacing-id" placeholder="Enter louvered panel name"></textarea>
                </div>
                <div class="form-group">
                  <label for="ladder-spacing-price-id">Price *</label>
                  <input type="number" required class="form-control" name="l_name_price" id="ladder-spacing-price-id" placeholder="Enter louvered panel price">
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
        $("#add-master-height-id").click(function(){
          $("#add-edit-master-height-id").html("Pick Louvered Panel (Add Form)");
          $("#add-edit-master-height-action-id").find('#ladder-spacing-id').val("");
          $("#add-edit-master-height-action-id").find('#ladder-spacing-price-id').val("");
          $("#add-edit-master-height-action-id").attr("action","{{ route('admin.submit-pick-panel') }}");
        })
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
            url: "{{ route('admin.show-pick-panel') }}",
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
            url: "{{ route('admin.pick-panel-action-change') }}",
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
        $.ajax({
            url: "{{ route('admin.pick-panel-action-del') }}",
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


    function make_edit_change(id)
    {
        var window_lc = window.origin;
        var main_ul_window = window_lc+"/admin/add-pick-panel#add-edit-master-height-id";
        window.location.href=main_ul_window;
        var url_id= "{{ url('admin/admin-pick-panel-edit') }}"+"/"+id;
        $.ajax({
            url: "{{ route('admin.pick-panel-action-view-edit') }}",
            type: "GET",
            data: {id: id},
            dataType: "json",
            success: function(event){
                $("#add-edit-master-height-id").html("Pick Louvered Panel (Edit Form)");
                $("#add-edit-master-height-action-id").find('#ladder-spacing-id').val(event.l_panel_name);
                $("#add-edit-master-height-action-id").find('#ladder-spacing-price-id').val(event.l_panel_price);
                $("#add-edit-master-height-action-id").attr("action",url_id);
            }, error: function(event){

            }
        })
    }
</script>
@endsection