<?php

namespace App\Http\Controllers;

use App\Map;
use App\Hospitals;
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

	public function marker() {
		$hospName = self::getFrsHospName();
		if (!is_null($hospName)) {
			$marker_map = DB::table('z_rp_map_marker')->select(
				'hoscode',
				'lon',
				'lat',
				\DB::raw('SUM(IF(lab_code = "2", 1, 0)) AS "b"'),
				\DB::raw('SUM(IF(lab_code = "5", 1, 0)) + SUM(IF(lab_code = "6", 1, 0)) AS "flu_a"'),
				\DB::raw('SUM(IF(lab_code = "7", 1, 0)) AS "flu_h"'),
				\DB::raw('SUM(IF(lab_code = "86", 1, 0)) AS "neg"')
			)->groupBy('hoscode', 'lon', 'lat')->get()->keyBy('hoscode');
		} else {
			$marker_map = null;
		}
		return view('maps.marker', [
			'hosp_name' => $hospName,
			'marker_map' => $marker_map
		]);
	}

	private function getFrsHospcode() {
		return DB::table('z_rp_map_marker')->select('hoscode')->groupBy('hoscode')->get()->toArray();
	}

	private function getFrsHospName() {
		$frsHospcode = self::getFrsHospcode();
		if (count($frsHospcode) > 0) {
			foreach ($frsHospcode as $value) {
				$result = Hospitals::select('hosp_name')->where('hospcode', '=', $value->hoscode)->get()->toArray();
				$hospName[$value->hoscode] = $result[0]['hosp_name'];
			}
			return $hospName;
		} else {
			return null;
		}
	}
}
