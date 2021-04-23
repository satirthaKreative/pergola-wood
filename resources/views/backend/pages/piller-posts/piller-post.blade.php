@extends('backend.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>
          Master Posts
          <!-- Pick a Footprint (outside post to post) -->
          </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Master Posts</li>
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
              <h3 class="card-title">No of Posts Table</h3>
              <span class="float-right" id="piller-state-id"><a href="javascript: ;" onclick="change_piller_table_minus_state()" class="btn btn-danger btn-sm"><i class="fa fa-minus"></i></a></span><span class="float-right"><a class="btn btn-danger btn-sm" href="#add-edit-piller-heading-id" id="add-master-height-id" style="margin-right: 10px;">Add Posts</a></span>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive scroll-demo-table p-0" >
            <div style="padding: 10px">
              <table class="table table-hover text-nowrap" id="show-piller-post-id">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>No. Of Posts</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="campaign-tbl-id">
                  <tr>
                    <td colspan="4"><center class="text-info"><i class="fa fa-spinner"></i> Loading data's</center></td>
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
              <h3 class="card-title" id="add-edit-piller-heading-id">No. of Posts (Add Form) </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="POST" action="" id="post-form-id">
            
              <div class="card-body">
                <div class="form-group">
                  <label for="no-of-posts-id">No. of posts</label>
                  <input type="number" class="form-control" name="no_of_posts" id="no-of-posts-id" placeholder="Enter no. of posts">
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" class="btn btn-primary" id="posts-add-edit-submit-btn-id" onclick="submit_posts()">Submit</button>
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
          $("#add-edit-piller-heading-id").html("No. of Posts (Add Form)");
          $("#post-form-id").find("#no-of-posts-id").val("");
          $("#posts-add-edit-submit-btn-id").attr("onclick","submit_posts()");
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


    function submit_posts()
    {
        var posts_count = $("#no-of-posts-id").val();
        if(posts_count == "")
        {
            var alert_msg = "Please add no. of posts";
            error_pass_alert_show_msg(alert_msg);
        }
        else
        {
            $.ajax({
                url: "{{ route('admin.submit-piller-posts') }}",
                type: "GET",
                data: {posts_count: posts_count},
                dataType: "json",
                success: function(event){
                    if(event == "success")
                    {
                        var alert_msg = "Successfully posts added";
                        success_pass_alert_show_msg(alert_msg);
                        $("#no-of-posts-id").val("");
                        show_piller_posts_table();
                    }
                    else if(event == "error")
                    {
                        var alert_msg = "Something wrong! Try again later";
                        error_pass_alert_show_msg(alert_msg);
                    }
                    else if(event == "already")
                    {
                        var alert_msg = "This number of posts are already added";
                        error_pass_alert_show_msg(alert_msg);
                    }
                    else
                    {
                        var alert_msg = "Server getting down! Try again later";
                        error_pass_alert_show_msg(alert_msg);
                    }
                }, error: function(event){

                }
            })
        }
    }

    function show_piller_posts_table()
    {
        $.ajax({
            url: "{{ route('admin.show-piller-post') }}",
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
            url: "{{ route('admin.piller-action-change') }}",
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
            url: "{{ route('admin.piller-action-del') }}",
            type: "GET",
            data: {id: id},
            dataType: "json",
            success: function(event){
                if(event == "success")
                {
                    msg = "Delete action successfully applied";
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


    function make_edit_change(id)
    {
      
        $.ajax({
            url: "{{ route('admin.piller-action-get-edit') }}",
            type: "GET",
            data: {id: id},
            dataType: "json",
            success: function(event){
                $("#post-form-id").find("#no-of-posts-id").val(event);
                $("#add-edit-piller-heading-id").html("No. of Posts (Edit Form)");
                $("#posts-add-edit-submit-btn-id").attr("onclick","submit_sdit_posts("+id+")");
            }, error: function(event){

            }
        })
    }

    function submit_sdit_posts(id)
    {
      
      var posts_count = $("#no-of-posts-id").val();
        if(posts_count == "")
        {
            var alert_msg = "Please add no. of posts";
            error_pass_alert_show_msg(alert_msg);
        }
        else
        {
            $.ajax({
                url: "{{ route('admin.piller-action-edit') }}",
                type: "GET",
                data: {posts_count: posts_count, id: id},
                dataType: "json",
                success: function(event){
                    if(event == "success")
                    {
                        var alert_msg = "Successfully posts edited";
                        success_pass_alert_show_msg(alert_msg);
                        $("#no-of-posts-id").val("");
                        show_piller_posts_table();
                        location.reload();
                    }
                    else if(event == "error")
                    {
                        var alert_msg = "Something wrong! Try again later";
                        error_pass_alert_show_msg(alert_msg);
                    }
                    else if(event == "already")
                    {
                        var alert_msg = "This number of posts are already added";
                        error_pass_alert_show_msg(alert_msg);
                    }
                    else
                    {
                        var alert_msg = "Server getting down! Try again later";
                        error_pass_alert_show_msg(alert_msg);
                    }
                }, error: function(event){

                }
            })
        }
    }
</script>
@endsection