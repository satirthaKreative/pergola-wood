@extends('backend.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Pick a Footprint (outside post to post)</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Pick a Footprint</li>
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
              <h3 class="card-title">Pick a Footprint (outside post to post)</h3>
              <span class="float-right"><a href="{{ route('admin.view-pick-a-footprint') }}" class="btn btn-danger btn-sm">View Pick a Footprint</a></span>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" enctype="multipart/form-data" method="POST" action="{{ route('admin.insert-pick-a-footprint') }}">
            @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="width-in-feet-master">Width (In Feet *)</label>
                  <select onchange=width_in_feet_master_fx() class="form-control" name="width_in_feet_master" id="width-in-feet-master" placeholder="">
                    <option value="">Choose A Master Width</option>
                  </select>
                </div>
                <div  id="pick-up-footprint-height-body-id">

                </div>
                <div  id="pick-up-footprint-post-body-id">

                </div>
                <div  id="pick-up-footprint-img-body-id">

                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary" id="pickup-submit-btn">Submit</button>
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
    
</script>
@endsection