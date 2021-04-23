@extends('backend.app')
@section('content')
<style>
.card_panel_body h4{
  color: #000;
    font-size: 18px;
    font-weight: 600;
    margin: 0;
}
.card_panel_body label{
  color: #666;
    font-size: 16px;
    font-weight: 400 !important;
    margin: 10px 0 7px;
}
</style>
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Combination Panel</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Combination Panel</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Combination Panel Table</h3>
              <span class="float-right" id="piller-state-id"><a href="javascript: ;" onclick="change_piller_table_minus_state()" class="btn btn-danger btn-sm"><i class="fa fa-minus"></i></a></span>
              <span class="float-right"><a class="btn btn-danger btn-sm" href="#add-master-height" id="add-master-height-id" style="margin-right: 10px;">Add Combination Panel</a></span>
            </div>
            <div style="padding: 10px" id="show-piller-post-id"> 
              <div class="card-body table-responsive scroll-demo-table p-0">
                <table id="myTable" class="table table-hover text-nowrap">
                    <thead>
                    <tr>
                        <th>S.no</th>
                        <th>Combination Panel</th>
                        <th>Mount Bracket Price</th>
                        <th>Canopy Panel</th>
                        <th>Louvered Panel</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="myTable-data">
                        <tr>
                            <td colspan="7"><center class="text-info"><i class="fa fa-spinner"></i> Loading Data's</center></td>
                        </tr>
                    </tbody>
                </table>
              </div>
            </div>
            </div>
          </div>
        </div>
        <div class="row">
        <!-- left column -->
        <div class="col-md-6" id="add-master-height">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title" id="add-edit-master-height-id">Combination Panel ( Add Form ) </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" enctype="multipart/form-data" id="add-edit-master-height-action-id" method="POST" action="{{ route('admin.combination-panel-add') }}">
            @csrf
              <div class="card-body card_panel_body">
                <div class="form-group">
                  <label for="ladder-spacing-id">Combination Panel *</label>
                    <select class="form-control" name="combination_name" id="combination-panel-id" required>
                            <option value="">Choose combination panel</option>
                    </select>
                </div>
                <div class="form-group">
                  <h4 for="ladder-spacing-id">POST MOUNT BRACKET *</h4>
                  <label for="ladder-spacing-id">Existing Price *</label>
                    <input type="text" class="form-control" name="exist_price" id="existing-price-id" required>
                  <label for="ladder-spacing-id">New Price *</label>
                    <input type="text" class="form-control" name="new_price" id="new-price-id" required>
                </div>
                <div class="form-group">
                  <h4 for="ladder-spacing-id">POST RETACTABLE CANOPY *</h4>
                  <label for="ladder-spacing-id">Canpony Price *</label>
                    <input type="text" class="form-control" name="canopy_price" id="canopy-price-id" required>
                  <label for="ladder-spacing-id">Canopy Description *</label>
                    <textarea class="form-control" name="canopy_description" id="canopy-des-id" required></textarea>
                </div>
                <div class="form-group">
                  <h4 for="ladder-spacing-id">POST LOUVERED PANEL *</h4>
                  <label for="ladder-spacing-id">left price*</label>
                    <input type="text" class="form-control" required name="left_price" id="left-price-id">
                  <label for="ladder-spacing-id">rear Price *</label>
                    <input type="text" class="form-control" required name="rear_price" id="rear-price-id">
                  <label for="ladder-spacing-id">right Price *</label>
                    <input type="text" class="form-control" required name="right_price" id="right-price-id">
                  <label for="ladder-spacing-id">left + rear Price *</label>
                    <input type="text" class="form-control" required name="left_rear_price" id="left-right-price-id">
                  <label for="ladder-spacing-id">right + rear Price *</label>
                    <input type="text" class="form-control" required name="right_rear_price" id="right-rear-price-id">
                  <label for="ladder-spacing-id">left + right + rear Price *</label>
                    <input type="text" class="form-control" required name="left_right_rear_price" id="left-right-rear-price-id">
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
    </div>
</section>
<!-- /.content -->
@endsection
@section('adminjsContent')
<script>
    $(function(){
        showDataPanelfx();
        show_add_tbl_data_fx();
        $("#add-master-height-id").click(function(){
          $("#add-edit-master-height-id").html("Combination Panel ( Add Form )");
          $("#add-edit-master-height-action-id").find('#master-height-id').val("");
          $("#add-edit-master-height-action-id").attr("action","{{ route('admin.combination-panel-add') }}");
        })
    });
    // show_add_tbl_data_fx

    function show_add_tbl_data_fx()
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

    // plus minus start

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

    // plus minus end
   

    function showDataPanelfx()
    {
        $.ajax({
            url: "{{ route('admin.combination-panel-show-tbl') }}",
            type: "GET",
            dataType: "json",
            success: function(event){
                $("#myTable-data").html(event.finalCombination);
                $("table").dataTable();
            }, error: function(event){

            }
        })
    }

    function make_btn_change(state, id)
    {
        $.ajax({
            url: "{{ route('admin.combination-panel-action-change') }}",
            type: "GET",
            data: {state: state, id: id},
            dataType: "json",
            success: function(event){
                if(event == "success")
                {
                    msg = "Admin action successfully applied";
                    success_pass_alert_show_msg(msg);
                    showDataPanelfx();
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
            url: "{{ route('admin.combination-panel-del') }}",
            type: "GET",
            data: {id: id},
            dataType: "json",
            success: function(event){
                if(event == "success")
                {
                    msg = "Delete action successfully applied";
                    success_pass_alert_show_msg(msg);
                    showDataPanelfx();
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
        var url_id= "{{ url('admin/combination-panel-edit-submit') }}"+"/"+id;
        $.ajax({
            url: "{{ route('admin.combination-panel-edit') }}",
            type: "GET",
            data: {id: id},
            dataType: "json",
            success: function(event){
                $("#add-edit-master-height-id").html("Combination Panel ( Edit Form )");
                $("#add-edit-master-height-action-id").find('#master-height-id').val(event);
                $("#add-edit-master-height-action-id").attr("action",url_id);
                $("#combination-panel-id").html(event.combination_data);

                $("#existing-price-id").val(event.exist_price);
                $("#new-price-id").val(event.new_price);

                $("#canopy-price-id").val(event.canopy_price);
                $("#canopy-des-id").val(event.canopy_details);

                $("#left-price-id").val(event.left_price);
                $("#right-price-id").val(event.right_price);
                $("#rear-price-id").val(event.rear_price);
                $("#left-right-price-id").val(event.left_rear_price);
                $("#right-rear-price-id").val(event.right_rear_price);
                $("#left-right-rear-price-id").val(event.left_right_rear_price);
            }, error: function(event){

            }
        })
    }
</script>
@endsection