<!-- Deze pagina is de basis voor al mijn views aan de admin side -->
<!DOCTYPE html>
<html lang='en'>
<head>
	<!-- de head inladen -->
	@include('admin/layouts/head3')
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
		@include('admin/layouts/footer3')
  </div>
</body>
</html>