@extends('layouts.index')
@section('top-script')
<!-- Charts js Files -->
	{{ Html::script('assets/libs/flot/excanvas.js') }}
	{{ Html::script('assets/libs/flot/jquery.flot.js') }}
	{{ Html::script('assets/libs/flot/jquery.flot.pie.js') }}
	{{ Html::script('assets/libs/flot/jquery.flot.time.js') }}
	{{ Html::script('assets/libs/flot/jquery.flot.stack.js') }}
	{{ Html::script('assets/libs/flot/jquery.flot.crosshair.js') }}
	{{ Html::script('assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js') }}
	{{ Html::script('dist/js/pages/chart/chart-page-init.js') }}
	{{ Html::script('assets/extra-libs/chart.js/Chart.min.js') }}
	{{ Html::script('assets/extra-libs/chart.js/utils.js') }}
	<script src="https://bot.ddc.moph.go.th/ddc-chatbot/js/canvasjs.min.js"></script>
@endsection
@section('contents')
<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">Dashboard</h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="col-3">
							<div class="bg-info p-10 text-white text-center">
								<i class="fas fa-flask m-b-5 font-24"></i>
								<h3 class="m-b-0 m-t-5">{{ $case_all }}</h3>
								<h5 class="font-light">Total Case</h5>
							</div>
						</div>
						<div class="col-3">
							<div class="bg-cyan p-10 text-white text-center">
								<i class="fab fa-odnoklassniki m-b-5 font-24"></i>
								<h3 class="m-b-0 m-t-5">{{ $case_gen_code }}</h3>
								<h5 class="font-light">New Case</h5>
							</div>
						</div>
						<div class="col-3">
							<div class="bg-danger p-10 text-white text-center">
								<i class="fab fa-odnoklassniki m-b-5 font-24"></i>
								<h3 class="m-b-0 m-t-5">{{ $case_hos_send }}</h3>
								<h5 class="font-light">Await lab</h5>
							</div>
						</div>
						<div class="col-3">
							<div class="bg-success p-10 text-white text-center">
								<i class="fab fa-odnoklassniki m-b-5 font-24"></i>
								<h3 class="m-b-0 m-t-5">{{ $case_lab_confirm }}</h3>
								<h5 class="font-light">Complete</h5>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Total by sex</h5>
					<div id="chartContainer" style="height: 370px; width: 100%;"></div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Data/Month</h5>
					<div style="height: 370px; width: 100%;">
						<canvas id="canvas"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Rapid Test</h5>
					<div style="height: 370px; width: 100%;">
						<canvas id="chart-area"></canvas>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Anti</h5>
					<div style="height: 370px; width: 100%;">
						<canvas id="chart-area1"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>



</div>
@endsection
@section('bottom-script')
<script>



</script>
<script>
window.onload = function() {

	/* donough chart pat */
	var chart = new CanvasJS.Chart("chartContainer", {
		theme: "light2",
		animationEnabled: true,
		title: {
			text: ""
		},
		data: [{
			type: "doughnut",
			indexLabel: "{symbol} - {y}",
			//yValueFormatString: "#,##0.0\"%\"",
			showInLegend: true,
			legendText: "{label} : {y}",
			dataPoints: <?php echo json_encode($donut_charts_arr, JSON_NUMERIC_CHECK); ?>
		}]
	});
	chart.render();

	/* barchart */
	var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
	var color = Chart.helpers.color;
	var barChartData = {
		labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
		datasets: [{
			label: '2018',
			backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
			borderColor: window.chartColors.red,
			borderWidth: 1,
			data: [
				0,
				0,
				0,
				0,
				0,
				0,
				0,
				0,
				5,
				41,
				24,
				29,
			]
		}, {
			label: '2019',
			backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
			borderColor: window.chartColors.blue,
			borderWidth: 1,
			data: [
				65,
				59,
				71,
				43,
				44,
				90,
				29,
				7,
				0,
				0,
				0,
				0,
			]
		}]

	};
	var ctx = document.getElementById('canvas').getContext('2d');
	window.myBar = new Chart(ctx, {
		type: 'bar',
		data: barChartData,
		options: {
			responsive: true,
			legend: {
				position: 'top',
			},
			title: {
				display: false,
				text: 'Bar Chart'
			}
		}
	});

	/* PolarArea chart */
	var chartColors = window.chartColors;
	var color = Chart.helpers.color;
	var config = {
		data: {
			datasets: [{
				data: [
					<?php
					foreach ($rapidResult as $key => $value) {
						echo $value.",";
					}
					?>
				],
				backgroundColor: [
					color(chartColors.red).alpha(0.5).rgbString(),
					color(chartColors.yellow).alpha(0.5).rgbString(),
					color(chartColors.green).alpha(0.5).rgbString(),
					color(chartColors.blue).alpha(0.5).rgbString(),
				],
				label: 'My dataset' // for legend
			}],
			labels: [
				'Flu-a',
				'Flu-b',
				'Nagative',
				'Unknown',
			]
		},
		options: {
			responsive: true,
			legend: {
				position: 'right',
			},
			title: {
				display: false,
				text: 'Rapid Test'
			},
			scale: {
				ticks: {
					beginAtZero: true
				},
				reverse: false
			},
			animation: {
				animateRotate: false,
				animateScale: true
			}
		}
	};
	var ctx = document.getElementById('chart-area');
	window.myPolarArea = Chart.PolarArea(ctx, config);


	/* */
	/* PolarArea chart */
	var chartColors = window.chartColors;
	var color = Chart.helpers.color;
	var config = {
		data: {
			datasets: [{
				data: [
					<?php
					foreach ($antiResult as $key => $value) {
						echo $value.",";
					}
					?>
				],
				backgroundColor: [
					color(chartColors.red).alpha(0.5).rgbString(),
					color(chartColors.yellow).alpha(0.5).rgbString(),
					color(chartColors.green).alpha(0.5).rgbString(),
					color(chartColors.blue).alpha(0.5).rgbString(),
				],
				label: 'My dataset' // for legend
			}],
			labels: [
				'anti_arv',
				'anti_osel',
				'anti_tamiflu',
				'anti_unknown',
			]
		},
		options: {
			responsive: true,
			legend: {
				position: 'right',
			},
			title: {
				display: false,
				text: 'Rapid Test'
			},
			scale: {
				ticks: {
					beginAtZero: true
				},
				reverse: false
			},
			animation: {
				animateRotate: false,
				animateScale: true
			}
		}
	};
	var ctx = document.getElementById('chart-area1');
	window.myPolarArea = Chart.PolarArea(ctx, config);


}
</script>
@endsection
