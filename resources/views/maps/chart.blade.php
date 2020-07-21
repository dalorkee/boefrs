@extends('layouts.index')
@section('custom-style')
	<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.11.1/mapbox-gl.css' rel='stylesheet'>
	<link href="https://api.mapbox.com/mapbox-assembly/v0.23.2/assembly.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
@endsection
@section('internal-style')
<style>
.page-wrapper {
	background: white !important;
}
#map {position: absolute; top:0; bottom: 0; width: 100%; }
.mapboxgl-popup {
	min-width: 400px;
	font: 12px/20px 'Helvetica Neue', Arial, Helvetica, sans-serif;
	z-index: 99999;
}
.mapboxgl-popup-content-wrapper {
	padding: 1%;
}
.marker {
	height: 15px;
	width: 15px;
	background-color: #CB98FF;
	border-radius: 50%;
	display: inline-block;
	cursor: pointer;
	z-index: 9999;
}
.marker b {transform: rotateZ(135deg)}
.dom-popup {
	border-radius: 4px;
	animation: gen .8s ease-in-out;
	border: 1px solid rgba(197, 197, 197, 0.44);
}
.dom-popup-gen {
	animation: gen .8s forwards;
}
@keyframes gen {
	from {transform: scale(0);}
	to {transform: scale(1);}
}
.dom-ele:hover, .dom-popup:hover {
	/*box-shadow: 0px 0px 2px rgba(255, 255, 255, 0.8);*/
}
.dom-ele {
	background-color: #CB98FF;
	animation: expandLine 1.2s ease-in-out;
}
@keyframes expand {
	0% {width: 0; height: 0;}
	100% {width: 100%; height: 50px;}
}
@keyframes expandLine {
	from {height: 0;}
	to {height: 100%;}
}
</style>
@endsection
@section('contents')
<div class="page-breadcrumb bg-light pb-2">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">Map</h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Map</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid" style="margin:0;padding:0;">
	<div class="map-box">
		<div id="map"></div>
	</div>
</div>
@endsection
@section('bottom-script')
<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.11.1/mapbox-gl.js'></script>
<script src="{{ URL::asset('assets/extra-libs/chart.js/Chart.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/mapbox-plugins/bundle.js') }}"></script>
<script>
mapboxgl.accessToken = 'pk.eyJ1IjoiZGFsb3JrZWUiLCJhIjoiY2pnbmJrajh4MDZ6aTM0cXZkNDQ0MzI5cCJ9.C2REqhILLm2HKIQSn9Wc0A';
	var map = new mapboxgl.Map({
	container: 'map',
	style: 'mapbox://styles/mapbox/streets-v11',
	center: [ 100.503435, 13.7504999 ],
	zoom: 5
});

map.addControl(new mapboxgl.NavigationControl());

var domLayer = null;
map.on('load', function() {
	var geojson = {
		"type": "FeatureCollection",
		"features": [
			@foreach ($marker_map as $key => $value)
				@php
					$pc_b = (($value->b/($value->b+$value->flu_a+$value->flu_h+$value->neg))*100);
					$pc_flu_a = (($value->flu_a/($value->b+$value->flu_a+$value->flu_h+$value->neg))*100);
					$pc_flu_h = (($value->flu_h/($value->b+$value->flu_a+$value->flu_h+$value->neg))*100);
					$pc_neg = (($value->neg/($value->b+$value->flu_a+$value->flu_h+$value->neg))*100);
					$desc = "<div class=\"card\">";
						$desc .= "<div class=\"card-body\">";
							$desc .= "<h4 class=\"card-title m-b-0 border-bottom\"><i class=\"mdi mdi-hospital-marker\"></i> ".$hosp_name[$value->hoscode]."</h4>";
							$desc .= "<div class=\"m-t-20\">";
								$desc .= "<div class=\"d-flex no-block align-items-center\">";
									$desc .= "<span>B, ".number_format($pc_b, 2)."% </span>";
									$desc .= "<div class=\"ml-auto\"><span>".number_format($value->b)."</span></div>";
								$desc .= "</div>";
								$desc .= "<div class=\"progress\">";
									$desc .= "<div class=\"progress-bar progress-bar-striped\" role=\"progressbar\" style=\"width:".$pc_b."%;background-color:#ff6384;\" aria-valuenow=\"10\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>";
								$desc .= "</div>";
							$desc .= "</div>";
							$desc .= "<div class=\"d-flex no-block align-items-center m-t-15\">";
								$desc .= "<span>Flu A, ".number_format($pc_flu_a, 2)."%</span>";
								$desc .= "<div class=\"ml-auto\"><span>".number_format($value->flu_a)."</span></div>";
							$desc .= "</div>";
							$desc .= "<div class=\"progress\">";
								$desc .= "<div class=\"progress-bar progress-bar-striped\" role=\"progressbar\" style=\"width:".$pc_flu_a."%;background-color:#FFB447;\" aria-valuenow=\"10\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>";
							$desc .= "</div>";
							$desc .= "<div class=\"d-flex no-block align-items-center m-t-15\">";
								$desc .= "<span>Flu H, ".number_format($pc_flu_h, 2)."%</span>";
								$desc .= "<div class=\"ml-auto\"><span>".number_format($value->flu_h)."</span></div>";
							$desc .= "</div>";
							$desc .= "<div class=\"progress\">";
								$desc .= "<div class=\"progress-bar progress-bar-striped\" role=\"progressbar\" style=\"width:".$pc_flu_h."%;background-color:#36a2eb;\" aria-valuenow=\"10\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>";
							$desc .= "</div>";
							$desc .= "<div class=\"d-flex no-block align-items-center m-t-15\">";
								$desc .= "<span>Nagative, ".number_format($pc_neg, 2)."%</span>";
								$desc .= "<div class=\"ml-auto\"><span>".number_format($value->neg)."</span></div>";
							$desc .= "</div>";
							$desc .= "<div class=\"progress\">";
								$desc .= "<div class=\"progress-bar progress-bar-striped\" role=\"progressbar\" style=\"width:".$pc_neg."%;background-color:#77DD77;\" aria-valuenow=\"10\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>";
							$desc .= "</div>";
						$desc .= "</div>";
					$desc .= "</div>";
				@endphp
			{
				'type': 'Feature',
				'geometry': {
					'type': 'Point',
					'coordinates': [{{ $value->lon }} , {{ $value->lat }}]
				},
				'properties': {
					'title': '',
					'description': '{!!$desc!!}'
				}
			},
			@endforeach
		]
	};

	geojson.features.forEach(function(marker, i) {
		var el = document.createElement('div');
		el.className = 'marker';
		//el.innerHTML = '<span><b>' + (i + 1) + '</b></span>'
		el.innerHTML = ''

		new mapboxgl.Marker(el)
			.setLngLat(marker.geometry.coordinates)
			.setPopup(new mapboxgl.Popup({
				offset: 25
			})
			.setHTML('<div>' + marker.properties.description + '</div>'))
			.addTo(map);
	});

	domLayer = new Mapbox.DomOverlayer({
		map: map,
		doms: [
		@foreach ($marker_map as $key => $value)
			@php
				$pc_b = (($value->b/($value->b+$value->flu_a+$value->flu_h+$value->neg))*100);
				$pc_flu_a = (($value->flu_a/($value->b+$value->flu_a+$value->flu_h+$value->neg))*100);
				$pc_flu_h = (($value->flu_h/($value->b+$value->flu_a+$value->flu_h+$value->neg))*100);
				$pc_neg = (($value->neg/($value->b+$value->flu_a+$value->flu_h+$value->neg))*100);
			@endphp
			{
				'type': 'doughnut',
				'class': 'bounceIn',
				'data': {
					'datasets': [{
						'data': [{{$pc_b}}, {{$pc_flu_a}}, {{$pc_flu_h}}, {{$pc_neg}}],
						'backgroundColor': ['#ff6384', '#FFB447', '#36a2eb', '#77DD77']
					}],
					'labels': ['B', 'Flu A', 'Flu H', 'Neg']
				},
				'lon': {{$value->lon}},
				'lat': {{$value->lat}}
			},
		@endforeach
		]
	});
});
</script>
@endsection
