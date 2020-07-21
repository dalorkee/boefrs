@extends('layouts.index')
@section('custom-style')
<link href="https://api.tiles.mapbox.com/mapbox-gl-js/v0.53.1/mapbox-gl.css" rel="stylesheet">
<link href="https://api.mapbox.com/mapbox-assembly/v0.23.2/assembly.min.css" rel="stylesheet">
@endsection
@section('internal-style')
<style>
.page-wrapper {
	background: white !important;
}
.map-box {
	margin: 0;
	padding: 0;
	position:relative;
}
#map {
	position:absolute;
	top:0;
	bottom:0;
	width:100vw;
	height: 100vh;
}
#key {
	background-color: rgba(0, 0, 0, 0.8);
	width: 22.22%;
	height: auto;
	overflow: auto;
	position: absolute;
	top: 0;
	left: 0;
}
.total {
	font-family: 'Montserrat', sans-serif;
	font-weight: 800;
	font-size: 15px;
}
.table {
	font-family: 'Montserrat', sans-serif;
	color: white;
	border-collapse: collapse;
}
.pie {
	cursor: pointer;
}
</style>
@endsection
@section('contents')
<div class="page-breadcrumb bg-light pb-2">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">Spread map</h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Cluster Map</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid" style="margin:0;padding:0;">
	<div class="map-box">
	<div id="key" style="z-index:9999"></div>
	<div id="map"></div>
	</div>
</div>
@endsection
@section('bottom-script')
<script src="https://api.tiles.mapbox.com/mapbox-gl-js/v0.53.1/mapbox-gl.js"></script>
<script src="https://d3js.org/d3.v4.min.js"></script>
<script>
const powerplants = {
	"type": "FeatureCollection",
	"features": [
		@foreach ($rp_map as $key => $value)
		{
			"type": "Feature",
			"properties": {
				"description": "<ul class='evb-popup'><li><span>Lab Code</span><span>{{ $value->lab_code }}</span></li><li><span>จังหวัด</span><span> {{ $value->province_id }}</span></li></ul>",
				"country_long": "Thailand",
				"cluster": "cluster{{ $value->lab_code }}"
			},
			"geometry": {
				"type": "Point",
				"coordinates": [
					{{ $value->lon }},
					{{ $value->lat }}
				]
			}
		},
		@endforeach
	]
}
</script>
<script>
mapboxgl.accessToken = 'pk.eyJ1IjoiZGFsb3JrZWUiLCJhIjoiY2pnbmJrajh4MDZ6aTM0cXZkNDQ0MzI5cCJ9.C2REqhILLm2HKIQSn9Wc0A';
var map = new mapboxgl.Map({
	container: 'map',
	style: 'mapbox://styles/mapbox/streets-v11',
	center: [ 103.511621, 12.538136 ],
	zoom: 5.2
});
const colors = [' #B71C1C',' #E64A19 ','#E91E63','#FF00FF','#66BB6A', '#FDD835', '#1E90FF'];
const colorScale = d3.scaleOrdinal()
	.domain(["Influenza B Virus", "Flu A-H1", "Flu A-H1pdm09", "Flu A-H3", "Negative", "ตัวอย่างไม่มีคุณภาพ", "อื่นๆ"])
	.range(colors)
const cluster2 = ['==', ['get', 'cluster'], 'cluster2'];
const cluster5 = ['==', ['get', 'cluster'], 'cluster5'];
const cluster6 = ['==', ['get', 'cluster'], 'cluster6'];
const cluster7 = ['==', ['get', 'cluster'], 'cluster7'];
const cluster86 = ['==', ['get', 'cluster'], 'cluster86'];
const cluster97 = ['==', ['get', 'cluster'], 'cluster97'];
const cluster99 = ['==', ['get', 'cluster'], 'cluster99'];

map.on('load', () => {
// add a clustered GeoJSON source for powerplant
map.addSource('powerplants', {
	'type': 'geojson',
	'data': powerplants,
	'cluster': true,
	'clusterRadius': 100,
	'clusterProperties': { // keep separate counts for each fuel category in a cluster
		'cluster2': ['+', ['case', cluster2, 1, 0]],
		'cluster5': ['+', ['case', cluster5, 1, 0]],
		'cluster6': ['+', ['case', cluster6, 1, 0]],
		'cluster7': ['+', ['case', cluster7, 1, 0]],
		'cluster86': ['+', ['case', cluster86, 1, 0]],
		'cluster97': ['+', ['case', cluster97, 1, 0]],
		'cluster99': ['+', ['case', cluster99, 1, 0]],
	}
});

map.addLayer({
	'id': 'powerplant_individual',
	'type': 'circle',
	'source': 'powerplants',
	'filter': ['!=', ['get', 'cluster'], true],
	'paint': {
		'circle-color': ['case',
			cluster2, colorScale('cluster2'),
			cluster5, colorScale('cluster5'),
			cluster6, colorScale('cluster6'),
			cluster7, colorScale('cluster7'),
			cluster86, colorScale('cluster86'),
			cluster97, colorScale('cluster97'),
			cluster99, colorScale('cluster99'),
			'#ffed6f'],
		'circle-radius': 5
	}
});

map.addLayer({
	'id': 'powerplant_individual_outer',
	'type': 'circle',
	'source': 'powerplants',
	'filter': ['!=', ['get', 'cluster'], true],
	'paint': {
		'circle-stroke-color': ['case',
			cluster2, colorScale('cluster2'),
			cluster5, colorScale('cluster5'),
			cluster6, colorScale('cluster6'),
			cluster7, colorScale('cluster7'),
			cluster86, colorScale('cluster86'),
			cluster97, colorScale('cluster97'),
			cluster99, colorScale('cluster99'),
			'#ffed6f'],
		'circle-stroke-width': 2,
		'circle-radius': 10,
		'circle-color': "rgba(0, 0, 0, 0)"
	}
});

let markers = {};
let markersOnScreen = {};
let point_counts = [];
let totals;

const getPointCount = (features) => {
	features.forEach(f => {
		if (f.properties.cluster) {
			point_counts.push(f.properties.point_count)
		}
	})
	return point_counts;
};

const updateMarkers = () => {
	document.getElementById('key').innerHTML = '';
	let newMarkers = {};
	const features = map.querySourceFeatures('powerplants');
	totals = getPointCount(features);
	features.forEach((feature) => {
		const coordinates = feature.geometry.coordinates;
		const props = feature.properties;
		if (!props.cluster) {
			return;
		};
		const id = props.cluster_id;
		let marker = markers[id];
		if (!marker) {
			const el = createDonutChart(props, totals);
				marker = markers[id] = new mapboxgl.Marker({
					element: el
			})
		.setLngLat(coordinates)
		}
		newMarkers[id] = marker;
		if (!markersOnScreen[id]) {
			marker.addTo(map);
		}
	});
	for (id in markersOnScreen) {
		if (!newMarkers[id]) {
			markersOnScreen[id].remove();
		}
	}
	markersOnScreen = newMarkers;
};

const createDonutChart = (props, totals) => {
	const div = document.createElement('div');
	const data = [
		{type: 'Influenza B Virus', count: props.cluster2},
		{type: 'Flu A-H1', count: props.cluster5},
		{type: 'Flu A-H1pdm09', count: props.cluster6},
		{type: 'Flu A-H3', count: props.cluster7},
		{type: 'Negative', count: props.cluster86},
		{type: 'ตัวอย่างไม่มีคุณภาพ', count: props.cluster97},
		{type: 'อื่นๆ', count: props.cluster99},
	];
	const thickness = 10;
	const scale = d3.scaleLinear()
		.domain([d3.min(totals), d3.max(totals)])
		.range([500, d3.max(totals)])
	const radius = Math.sqrt(scale(props.point_count));
	const circleRadius = radius - thickness;
	const svg = d3.select(div)
		.append('svg')
		.attr('class', 'pie')
		.attr('width', radius * 2)
		.attr('height', radius * 2);
	//center
	const g = svg.append('g')
		.attr('transform', `translate(${radius}, ${radius})`);
	const arc = d3.arc()
		.innerRadius(radius - thickness)
		.outerRadius(radius);
	const pie = d3.pie()
		.value(d => d.count)
		.sort(null);
	const path = g.selectAll('path')
		.data(pie(data.sort((x, y) => d3.ascending(y.count, x.count))))
		.enter()
		.append('path')
		.attr('d', arc)
		.attr('fill', (d) => colorScale(d.data.type))
	const circle = g.append('circle')
		.attr('r', circleRadius)
		.attr('fill', 'rgba(0, 0, 0, 0.7)')
		.attr('class', 'center-circle')
	const text = g
		.append("text")
		.attr("class", "total")
		.text(props.point_count_abbreviated)
		.attr('text-anchor', 'middle')
		.attr('dy', 5)
		.attr('fill', 'white')
	const infoEl = createTable(props);
	svg.on('click', () => {
		d3.selectAll('.center-circle').attr('fill', 'rgba(0, 0, 0, 0.7)')
		circle.attr('fill', 'rgb(71, 79, 102)')
		document.getElementById('key').innerHTML = '';
		document.getElementById('key').append(infoEl);
	})
	return div;
}

const createTable = (props) => {
	const getPerc = (count) => {
		return count/props.point_count;
	};
	const data = [
		{type: 'Influenza B Virus', perc: getPerc(props.cluster2)},
		{type: 'Flu A-H1', perc: getPerc(props.cluster5)},
		{type: 'Flu A-H1pdm09', perc: getPerc(props.cluster6)},
		{type: 'Flu A-H3', perc: getPerc(props.cluster7)},
		{type: 'Negative', perc: getPerc(props.cluster86)},
		{type: 'ตัวอย่างไม่มีคุณภาพ', perc: getPerc(props.cluster97)},
		{type: 'อื่นๆ', perc: getPerc(props.cluster99)},
	];
	const columns = ['type', 'perc']
	const div = document.createElement('div');
	const table = d3.select(div).append('table').attr('class', 'table')
	const thead = table.append('thead')
	const	tbody = table.append('tbody');

	thead.append('tr')
		.selectAll('th')
		.data(columns).enter()
		.append('th')
		.text((d) => {
			let colName = d === 'perc' ? '%' : 'Lab code'
			return colName;
		})
	const rows = tbody.selectAll('tr')
		.data(data.filter(i => i.perc).sort((x, y) => d3.descending(x.perc, y.perc)))
		.enter()
		.append('tr')
		.style('border-left', (d) => `20px solid ${colorScale(d.type)}`);

	// create a cell in each row for each column
	const cells = rows.selectAll('td')
		.data((row) => {
			return columns.map((column) => {
				let val = column === 'perc' ? d3.format(".2%")(row[column]) : row[column];
				return {column: column, value: val};
			});
		})
		.enter()
		.append('td')
		.text((d) => d.value)
		.style('text-transform', 'capitalize')
	return div;
}

map.on('data', (e) => {
	if (e.sourceId !== 'powerplants' || !e.isSourceLoaded) return;
		map.on('move', updateMarkers);
		map.on('moveend', updateMarkers);
		updateMarkers();
});

map.on('click', 'powerplant_individual', function (e) {
	var coordinates = e.features[0].geometry.coordinates.slice();
	var desc = e.features[0].properties.description;

	while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
		coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
	}

	new mapboxgl.Popup()
		.setLngLat(coordinates)
		.setHTML(desc)
		.addTo(map);
	});
});
</script>
@endsection
