<?php

namespace App\Http\Controllers;

use App\Map;
use Illuminate\Http\Request;
use DB;

class MapController extends Controller
{
	public function index() {
		$rp_map = DB::table('z_rp_map')
			->leftJoin('ref_province', 'z_rp_map.hos_prov', '=', 'ref_province.province_id')
			->select('ref_province.province_id', 'z_rp_map.year_result', 'z_rp_map.lab_code', 'z_rp_map.lat', 'z_rp_map.lon')
			->whereNotNull('z_rp_map.lab_code')
			->orderBy('z_rp_map.lab_code', 'ASC')
			->get();
		return view('maps.spread',
			['rp_map' => $rp_map]
		);
	}

	public function create() {

	}

	public function store(Request $request) {

	}

	public function show(Map $map) {

	}

	public function edit(Map $map) {

	}

	public function update(Request $request, Map $map) {

	}

	public function destroy(Map $map) {

	}
}
