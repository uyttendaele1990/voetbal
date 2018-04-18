<!DOCTYPE html>
<html lang='en'>
<head>
	<!-- de head inladen -->
	@include('admin/layouts/head')
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class='wrapper' style='background-color:white;'>
		<!-- de header inladen -->
		@include('admin/layouts/header')
		<!-- de sidebar inladen -->
		@include('admin/layouts/sidebar')
		<!-- de content die per pagina verschillend zal zijn inladen -->
    @section('main-content')
    <!-- die moet je dan ook tonen (showen) -->
      @show
      <!-- de footer inladen -->
		@include('admin/layouts/footer')
  </div>
</body>
</html>