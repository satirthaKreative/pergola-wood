<!DOCTYPE html>
<html>
	@include('backend.include.head')
	<body class="hold-transition sidebar-mini layout-fixed">
		<div class="wrapper">
			@include('backend.include.nav')
			@include('backend.include.header')
			<div class="content-wrapper">
				@yield('content')
			</div>
			@include('backend.include.footer')
		</div>
		@include('backend.include.footer-js')
		@yield('adminjsContent')
	</body>
</html>