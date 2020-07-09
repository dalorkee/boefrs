@extends('layouts.index')
@section('custom-style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css') }}">
@endsection
@section('internal-style')
<style>
.page-wrapper {
	background: #fff !important;
}
</style>
@endsection
@section('top-script')
	<script src="{{ URL::asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
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
	{{ Html::script('assets/libs/canvas-js/canvasjs.min.js') }}
@endsection
@section('contents')
<div class="page-breadcrumb bg-light pb-2">
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
	<!--
	<div class="row mb-3">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<div class="form-group">
				<label for="province">เลือกจังหวัด</label>
				<select name="provinceInput" class="form-control selectpicker show-tick" data-live-search="true" id="select_province">
					<option value="0">-- ทุกจังหวัด --</option>
					foreach($provinces as $key => $val)
						<option value="{ $val['province_id'] }}">{ $val['province_name'] }}</option>
					endforeach
				</select>
			</div>
		</div>
	</div> -->
	<div id="ajax_response">
		<div class="row mb-4">
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


		<div class="row">
			<div class="col-md-6">
				<div class="card border">
					<div class="card-body">
						<h5 class="card-title">Total by sex</h5>
						<div id="chartContainer" style="height: 370px; width: 100%;"></div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card border">
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
				<div class="card border">
					<div class="card-body">
						<h5 class="card-title">Rapid Test</h5>
						<div style="height: 370px; width: 100%;">
							<canvas id="chart-area"></canvas>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="card border">
					<div class="card-body">
						<h5 class="card-title">Anti</h5>
						<div style="height: 370px; width: 100%;">
							<canvas id="chart-area1"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="card border">
					<div class="card-body">
						<div style="width: 100%">
							<canvas id="canvas_chart_5l"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('bottom-script')
<script src="{{ URL::asset('assets/libs/bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js') }}"></script>
<script>
$('#select_province').on('change', function() {
	let id = $('#select_province').val();
	let url = '{{ route("prov", ":id") }}';
	url = url.replace(':id', id);
	window.open(url, '_blank');
});
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
			type: "pie",
			indexLabel: "{symbol} - {y}%",
			//yValueFormatString: "#,##0.0\"%\"",
			showInLegend: true,
			legendText: "{label} : {y}%",
			toolTipContent: "{y}%",
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





	var barChartData = {
		labels: [
			'1',
			'3',
			'5',
			'7',
			'9',
			'11',
			'13',
			'15',
			'17',
			'19',
			'21',
			'23',
			'25',
			'27',
			'29',
			'31',
			'33',
			'35',
			'37',
			'39',
			'41',
			'43',
			'45',
			'47',
			'49',
			'51',
			'1',
			'3',
			'5',
			'7',
			'9',
			'11',
			'13',
			'15',
			'17',
			'19',
			'21',
			'23',
			'25',
			'27',
			'29',
			'31',
			'33',
			'35',
			'37',
			'39',
			'41',
			'43',
			'45',
			'47',
			'49',
			'51'
		],
		datasets: [{
				label: 'Flu Positive',
				yAxisID: 'P',
				fill: false,
				borderColor: window.chartColors.blue,
				borderWidth: 2,
				data: [
					90,
					51,
					66,
					42,
					7,
					9,
					95,
					21,
					33,
					65,
					78,
					21,
					24,
					65,
					23,
					67,
					11,
					62,
					43,
					54,
					76,
					56,
					23,
					67,
					65,
					98,
					30,
					51,
					66,
					42,
					7,
					9,
					95,
					21,
					33,
					65,
					78,
					21,
					24,
					65,
					23,
					67,
					11,
					62,
					43,
					54,
					76,
					56,
					23,
					67,
					65,
					98
				],
				type: 'line'
		}, {
			label: 'A/H1 2009',
			backgroundColor: window.chartColors.yellow,
			data: [
				3,
				10,
				17,
				4,
				9,
				5,
				23,
				3,
				35,
				21,
				26,
				3,
				6,
				8,
				23,
				6,
				18,
				14,
				4,
				26,
				22,
				14,
				25,
				26,
				15,
				2,
				10,
				31,
				17,
				4,
				19,
				25,
				13,
				23,
				35,
				21,
				26,
				13,
				6,
				8,
				3,
				5,
				8,
				9,
				34,
				6,
				12,
				24,
				15,
				26,
				15,
				22
			]
		}, {
			label: 'A/H3',
			backgroundColor: window.chartColors.red,
			data: [
				5,
				3,
				21,
				8,
				7,
				32,
				45,
				16,
				21,
				23,
				14,
				15,
				21,
				14,
				27,
				32,
				14,
				18,
				19,
				16,
				11,
				14,
				16,
				8,
				18,
				20,
				14,
				23,
				21,
				8,
				16,
				32,
				45,
				26,
				21,
				23,
				54,
				35,
				21,
				34,
				27,
				32,
				34,
				18,
				9,
				16,
				21,
				14,
				26,
				18,
				28,
				10
			]
		}, {
			label: 'B',
			backgroundColor: window.chartColors.green,
			data: [
				45,
				21,
				35,
				40,
				43,
				78,
				32,
				98,
				34,
				56,
				21,
				77,
				23,
				54,
				3,
				21,
				12,
				22,
				34,
				56,
				77,
				12,
				77,
				99,
				32,
				10,
				45,
				21,
				35,
				40,
				43,
				78,
				32,
				98,
				34,
				56,
				21,
				77,
				23,
				54,
				3,
				21,
				12,
				22,
				34,
				56,
				77,
				12,
				77,
				99,
				32,
				10
			]
		}, {
			label: 'Nagative',
			backgroundColor: window.chartColors.gray,
			data: [
				30,
				51,
				66,
				42,
				7,
				9,
				95,
				21,
				33,
				65,
				78,
				21,
				24,
				65,
				23,
				67,
				11,
				62,
				43,
				54,
				76,
				56,
				23,
				67,
				65,
				98,
				30,
				51,
				66,
				42,
				7,
				9,
				95,
				21,
				33,
				65,
				78,
				21,
				24,
				65,
				23,
				67,
				11,
				62,
				43,
				54,
				76,
				56,
				23,
				67,
				65,
				98
			]
		}]
	};

	var ctx = document.getElementById('canvas_chart_5l').getContext('2d');
	window.myBar = new Chart(ctx, {
		type: 'bar',
		data: barChartData,
		options: {
			title: {
				display: true,
				text: 'จำนวนตัวอย่างที่ส่งตรวจ จำแนกตามผลการตรวจทางห้องปฏิบัติการ รายสัปดาห์ ตั้งแต่วันที่ 1 มกราคม 2562 ถึงวันที่ 10 สิงหาคม 2562'
			},
			legend: {
				position: 'bottom'
			},
			tooltips: {
				mode: 'index',
				intersect: true
			},
			responsive: true,
			scales: {
				xAxes: [{
					stacked: true,
					/*
					ticks: {
						autoSkip: true,
						maxRotation: 0,
						minRotation: 0
					} */
				}],
				yAxes: [{
					stacked: true,
					scaleLabel: {
						display: true,
						labelString: 'จำนวนตัวอย่าง'
					}
				}, {
					id: 'P',
					position: 'right',
					ticks: {
						max: 100,
						min: 1
					},
					scaleLabel: {
						display: true,
						labelString: 'ร้อยละที่ให้ผลบวก'
					}
				}]
			}
		}
	});


}
</script>
@endsection
