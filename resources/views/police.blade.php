@extends('layouts.app')

@section('content')

<head>
	<title>Access Google Maps API in PHP</title>
	<script type="text/javascript" src="{{ asset('js/googlemap.js') }}"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
	<style type="text/css">
		.body {
			height: 450px;
		}
		#map {
			width: 100%;
			height: 100%;
			border: 1px solid blue;
		}
		#data, #allData {
			display: none;
		}
	</style>
</head>
<body>
	<div class="body">
		<center><h1>Access Google Maps API in PHP</h1></center>
		<?php
			// require 'education.php';
			// $edu = new education;
			// $coll = $edu->getCollegesBlankLatLng();
			// $coll = json_encode($coll, true);
			// echo '<div id="data">' . $coll . '</div>'; 

			// $allData = $edu->getAllColleges();
			// $allData = json_encode($allData, true);
			// echo '<div id="allData">' . $allData . '</div>'; 
		?>
		<div id="map"></div>
	</div>
</body>
<script async defer
  src="https://maps.googleapis.com/maps/api/js?key={{config('googlemap')['map_apikey']}}&callback=loadMap">
</script>

@endsection