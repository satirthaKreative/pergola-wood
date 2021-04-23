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
            <li class="breadcrumb-item active">Order Details</li>
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
              <h3 class="card-title">Order Details Table</h3>
            </div>
            <!-- /.card-header -->
            <div style="padding: 10px" id="show-piller-post-id">
            <div class="card-body table-responsive scroll-demo-table p-0">
              <table class="table table-hover text-nowrap" >
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>OrderId</th>
                    <th>User Name</th>
                    <th>User Price</th>
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
      
    </div><!-- /.container-fluid -->
</section>
  <!-- /.content -->
@endsection
@section('adminjsContent')
<script>
    $(function(){
        load_pay_order_details_fx();
    });

    function load_pay_order_details_fx()
    {
        $.ajax({
            url: "{{ route('admin.order-details-actual') }}",
            type: "GET",
            dataType: "json",
            success: function(event){
                $("#campaign-tbl-id").html(event.order_details);
                $("table").dataTable();
            }, error: function(event){

            }
        })
    }

    function order_details_status_fx(id)
    {
        var order_details_status = $("#order_details_status"+id).val();
        $.ajax({
            url: "{{ route('admin.order-details-change-status') }}",
            type: "GET",
            data: {order_details_status: order_details_status, id: id},
            dataType: "json",
            success: function(event){
                load_pay_order_details_fx();
            }, error: function(event){

            }
        })
    }
</script>
@endsection