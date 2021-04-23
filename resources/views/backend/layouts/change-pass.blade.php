@extends('backend.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Change Password</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Change Password</li>
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
              <h3 class="card-title">Change Password Forms</h3>
                
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form">
            @csrf
              <div class="card-body">
                <div class="show-msg-success">

                </div>
                <div class="form-group">
                  <label for="new-password">New Password</label>
                  <input type="password" class="form-control" name="new_password" id="new-password" placeholder="Enter New Password" />
                </div>
                <div class="form-group">
                  <label for="confirm-password">Confirm Password</label>
                  <input type="password" class="form-control" name="confirm_password" id="confirm-password" placeholder="Enter Confirm Pasword" />
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" onclick="change_password_func()" class="btn btn-primary">Submit</button>
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
    function change_password_func()
    {
        var new_password = $("#new-password").val();
        var confirm_password = $("#confirm-password").val();

        if(new_password.length >= 8){

        $.ajax({
            url: "{{ route('admin.changePasswordSubmit') }}",
            type: "GET",
            data: {new_password: new_password, confirm_password: confirm_password},
            dataType: "json",
            success: function(event){
                if(event == "success")
                {
                    var pass_data = 'Password successfully changed.';
                    success_pass_alert_show_msg(pass_data);
                    $("#new-password").val(" ");
                    $("#confirm-password").val(" ");
                }
                else
                {
                    var pass_data = 'Try Again! Something Wrong';
                    error_pass_alert_show_msg(pass_data);
                    $(".show-msg-success").html('<span class="text-danger">Try Again! Something Wrong</span>').fadeIn().delay(3000).fadeOut('slow');
                    $("#confirm-password").val(" ");
                }
                
            }, error:  function(event){
                
            }
        })
        }
        else
        {
            var pass_data = 'Password length must be greater than seven characters';
            error_pass_alert_show_msg(pass_data);
            $("#new-password").val(" ");
            $("#confirm-password").val(" ");
        }
    }
</script>
@endsection