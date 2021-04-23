<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('backend/plugins/sparklines/sparkline.js') }}"></script>
<script src="{{ asset('backend/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('backend/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<script src="{{ asset('backend/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<script src="{{ asset('backend/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('backend/dist/js/adminlte.js') }}"></script>
<script src="{{ asset('backend/dist/js/pages/dashboard.js') }}"></script>
<script src="{{ asset('backend/dist/js/demo.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<!-- data-table jQuery -->
<script type="text/javascript" src="{{ asset('backend/data-table-asset/media/js/jquery.dataTables.min.js') }}"></script>
<!-- <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.js"></script> -->

<!-- success alert -->
@if(Session::has('success_msg'))
<script>
    swal({
      title: "Successful!",
      text: "{{ Session::get('success_msg') }}",
      icon: "success",
      button: false,
      timer: 3000
    });
</script>
@endif

<!-- error alert -->
@if(Session::has('error_msg'))
<script>
    swal({
      title: "Error!",
      text: "{{ Session::get('error_msg') }}",
      icon: "error",
      button: false,
      timer: 3000
    });
</script>
@endif

<script>
  function success_pass_alert_show_msg(alert_main_msg)
  {
    swal({
      title: "Successful!",
      text: alert_main_msg,
      icon: "success",
      button: false,
      timer: 3000
    });
  }

  function count_alert_unique_visitor(today_count, total_count, today_c, total_c)
  {
    var tStatus = "success";
    if(parseInt(today_c) == parseInt(0))
    {
      tStatus = "warning";
    }
    swal({
      title: today_count,
      text: total_count,
      icon: tStatus,
      button: "Ok",
      // timer: 3000
    });
  }

  function error_pass_alert_show_msg(alert_main_msg)
  {
    swal({
      title: "Error!",
      text: alert_main_msg,
      icon: "error",
      button: false,
      timer: 3000
    });
  }

  
</script>
<script>
$(".user-dp").click(function(e){
     $(".dp-mn").toggle('slow');//or just show instead of toggle
    
});
</script>