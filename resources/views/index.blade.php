@extends('layouts.app')

@section('content')
<head>
	<script type="text/javascript" src="{{ asset('js/googlemap.js') }}"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
	<style type="text/css">
		.body {
			height: 500px;
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
		@if (Auth::user()->user_type == 'admin')
			@php
				$usertype = 'admin';
			@endphp
		@elseif (Auth::user()->user_type == 'Police Station')
			@php
				$usertype = 'police';
			@endphp
		@elseif (Auth::user()->user_type == 'Hospital')
			@php
				$usertype = 'hospital';
			@endphp
		@elseif (Auth::user()->user_type == 'Fire Station')
			@php
				$usertype = 'fire';
			@endphp
		@endif
		<button onClick="{{ $usertype }}Map()">Reset Map</button>
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
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCmVVEoSiwb_3ZGH6dslZA573hdhRl3xNc&callback={{ $usertype }}Map">
</script>
@endsection