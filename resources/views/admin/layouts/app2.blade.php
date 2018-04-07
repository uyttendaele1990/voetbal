<!-- Deze pagina is de basis voor al mijn views die de /create en /edit route hebben aan de admin side -->
<!-- om eerlijk te zijn, ik had errors die ik oploste maar dan gingen mijn datatables kapot,
 dus heb ik een quickfix gezocht door met 2 verschillende footers te werken -->
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
		@include('admin/layouts/footer2')
  </div>
</body>
</html>