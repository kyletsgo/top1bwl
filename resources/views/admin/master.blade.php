<!DOCTYPE html>
<html lang="en">
<head>
	@include('admin.uc.head')
@if(Session::has('msg'))
	<script>alert('{{Session::get('msg')}}')</script>
@endif
<body>
	<!-- Preloader -->
	<div id="preloader">
		<div id="status"><i class="fa fa-spinner fa-spin"></i></div>
	</div>
	<section>
		@include('admin.uc.leftmenu')
		<!-- leftpanel -->
		<div class="mainpanel">
			@include('admin.uc.header')
			<!-- headerbar -->
			@include('admin.uc.pageheader')
			<div class="contentpanel">
				@include('common.errors')
				@yield('content')
				<!-- row -->
			</div>
			<!-- contentpanel -->
		</div>
		<!-- mainpanel -->
	</section>
	@include('admin.uc.foot')
</body>
@yield('extjs')
</html>
