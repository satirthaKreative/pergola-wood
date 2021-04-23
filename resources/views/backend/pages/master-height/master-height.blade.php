@extends('backend.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Master Height</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Master Height</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
            <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Master Height Table</h3>
              <span class="float-right" id="piller-state-id"><a href="javascript: ;" onclick="change_piller_table_minus_state()" class="btn btn-danger btn-sm"><i class="fa fa-minus"></i></a></span>
              <span class="float-right"><a class="btn btn-danger btn-sm" href="#add-master-height" id="add-master-height-id" style="margin-right: 10px;">Add Height</a></span>
            </div>
            <div style="padding: 10px" id="show-piller-post-id"> 
                <table id="myTable" >
                    <thead>
                    <tr>
                        <th>S.no</th>
                        <th>Height</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="myTable-data">
                        <tr>
                            <td colspan="4"><center class="text-info"><i class="fa fa-spinner"></i> Loading Data's</center></td>
                        </tr>
                    </tbody>
                </table>
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
              <h3 class="card-title" id="add-edit-master-height-id">Master Height ( Add Form ) </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" enctype="multipart/form-data" id="add-edit-master-height-action-id" method="POST" action="{{ route('admin.master-height-submit') }}">
            @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="ladder-spacing-id">Height *</label>
                  <input type="text" class="form-control" name="master_height" id="master-height-id" placeholder="Enter master height" />
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

        $("#add-master-height-id").click(function(){
          $("#add-edit-master-height-id").html("Master Height ( Add Form )");
          $("#add-edit-master-height-action-id").find('#master-height-id').val("");
          $("#add-edit-master-height-action-id").attr("action","{{ route('admin.master-height-submit') }}");
        })
    });

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
            url: "{{ route('admin.master-height-show') }}",
            type: "GET",
            dataType: "json",
            success: function(event){
                $("#myTable-data").html(event);
                $("table").dataTable();
            }, error: function(event){

            }
        })
    }

    function make_btn_change(state, id)
    {
        $.ajax({
            url: "{{ route('admin.master-height-action-change') }}",
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
            url: "{{ route('admin.master-height-action-del') }}",
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
        var url_id= "{{ url('admin/master-height-action-edit') }}"+"/"+id;
        $.ajax({
            url: "{{ route('admin.master-height-action-get-edit') }}",
            type: "GET",
            data: {id: id},
            dataType: "json",
            success: function(event){
                $("#add-edit-master-height-id").html("Master Height ( Edit Form )");
                $("#add-edit-master-height-action-id").find('#master-height-id').val(event);
                $("#add-edit-master-height-action-id").attr("action",url_id);
            }, error: function(event){

            }
        })
    }
</script>
@endsection