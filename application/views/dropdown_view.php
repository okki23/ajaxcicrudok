<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width = device-width, initial-scale=1">
		<title>CI Dependent and Multiple Dropdown</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">

	</head>
	<body>

		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<h2>Silahkan Pilih:</h2>
					<a href="<?php echo base_url('mahasiswa'); ?>">Dependent Dropdown (MAHASISWA)</a> ||
					<a href="<?php echo base_url('skkm'); ?>">Multiple Dropdown (SKKM)</a>
				</div>
			</div>
		</div>

		<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>" charset="utf-8"></script>
		<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>" charset="utf-8"></script>
	</body>
</html>
