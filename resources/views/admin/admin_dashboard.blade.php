<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
	<meta name="author" content="NobleUI">
	<meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<title>ESC - HTML Bootstrap 5 Admin Dashboard Template</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <!-- End fonts -->

	<!-- core:css -->
	<link rel="stylesheet" href="{{ asset('assets/vendors/core/core.css') }}">
	<!-- endinject -->

	<!-- Plugin css for this page -->
	<link rel="stylesheet" href="{{ asset('assets/vendors/flatpickr/flatpickr.min.css') }}">
	<!-- End plugin css for this page -->

	<!-- inject:css -->
	<link rel="stylesheet" href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
	<!-- endinject -->

  <!-- Layout styles -->
	<link rel="stylesheet" href="{{ asset('assets/css/demo2/style.css') }}">
  <!-- End layout styles -->

  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/tinymce@7.2.1/skins/ui/oxide/content.min.css" rel="stylesheet">

  {{-- @yield('style') --}}
</head>
<body>
	<div class="main-wrapper">

		<!-- partial:partials/_sidebar.html -->
        @include('admin.body.sidebar')

		<!-- partial -->
	
		<div class="page-wrapper">
					
			<!-- partial:partials/_navbar.html -->
            @include('admin.body.header')
			<!-- partial -->

            @yield('admin')

            <!-- partial:partials/_footer.html -->
            @include('admin.body.footer')
			<!-- partial -->
		
		</div>
	</div>

	<!-- core:js -->
	<script src="{{ asset('assets/vendors/core/core.js') }}"></script>
	<!-- endinject -->

	<!-- Plugin js for this page -->
  <script src="{{ asset('assets/vendors/flatpickr/flatpickr.min.js') }}"></script>
  <script src="{{ asset('assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
	<!-- End plugin js for this page -->
s
	<!-- inject:js -->
	<script src="{{ asset('assets/vendors/feather-icons/feather.min.js') }}"></script>
	<script src="{{ asset('assets/js/template.js') }}"></script>
	<!-- endinject -->

	<!-- Custom js for this page -->
  <script src="{{ asset('assets/js/dashboard-dark.js') }}"></script>
	<!-- End custom js for this page -->

	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.2.1/tinymce.min.js"></script>

	<!-- PrismJS JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/9000.0.1/prism.min.js"
		integrity="sha512-UOoJElONeUNzQbbKQbjldDf9MwOHqxNz49NNJJ1d90yp+X9edsHyJoAs6O4K19CZGaIdjI5ohK+O2y5lBTW6uQ=="
		crossorigin="anonymous"
		referrerpolicy="no-referrer">
	</script> --}}


	@yield('script')
	<script type="text/javascript">


	</script>
@yield('script')
@stack('scripts')

<script type="text/javascript">

	$('#country').on('change', function() {
        var countryId = this.value;
        $('#state').html('');

        var url = "{{ url('get-states-record/') }}/" + countryId;
        console.log(url);

        $.ajax({
            url: url,
            type: 'GET',
            success: function(data) {
                // $('#state').html('<option value="">Select State</option>');
                $.each(data, function(key, value) {
                    console.log(value.state_name);
                    $('#state').append('<option value="' + value.id + '">' + value.state_name + '</option>');
                });
            }
        });
    });
</script>


<script type="text/javascript">
	$(document).ready(function () {
		$('#country_v').on('change', function() {
			var countryId = this.value;
			// $('#state_v').html('');
			$('#city_v').html('<option value="">Select City</option');

			var url = "{{ url('get-states') }}/" + countryId;
			console.log(url);
			$.ajax({
            url: url,
            type: 'GET',
            success: function(data) {
					$('#state_v').html('<option value="">Select State</option>');
					$.each(data, function(key, value) {
						console.log(value.state_name);
						$('#state_v').append('<option value="' + value.id + '">' + value.state_name + '</option>');
					});
				}
			});
		});

		$('#state_v').on('change', function() {
			var stateID = this.value;
			// $('#city_v').html('');
			var url = "{{ url('get-cities') }}/" + stateID;
			console.log(url);
			$.ajax({
            url: url,
            type: 'GET',
            success: function(data) {
					$('#city_v').html('<option value="">Select City</option');
					$.each(data, function(key, value) {
						console.log(value.city_name);
						$('#city_v').append('<option value="' + value.id + '">' + value.city_name + '</option>');
					});
				}
			});
		});
	});
</script>

</body>
</html>
