<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Session;
use App\Counter;
use DB;

class HomeController extends BoeFrsController
{
	public function __construct(){
		$this->middleware('auth');
		$this->middleware(['role:admin|hospital|lab']);
		//$this->middleware(['permission:manageuser']);
		$this->middleware('page_session');

	}
	public function index(Request $request) {
		/* set counter */
		$last_created = $this->getIpAddrPeriodTime($_SERVER['REMOTE_ADDR']);
		if (count($last_created) <= 0) {
			$this->addTodayToDb();
		} else {
			$last_create_date = strtotime($last_created[0]['created_at']);
			$expire_date = (int)$last_create_date+(60*5);
			$currentDate = strtotime(date('Y-m-d H:i:s'));
			if ($expire_date < $currentDate) {
				$this->addTodayToDb();
			}
		}

		/* check permission and redirect */
		$roleArr = auth()->user()->roles->pluck('name');
		$userRole = $roleArr[0];
		if ($userRole == 'admin') {
			return redirect()->route('dashboard.index');
		} elseif ($userRole == 'hospital' || $userRole == 'lab') {
			return redirect()->route('dashboard.index');
		} else {
			return redirect()->route('logout');
		}
	}

	private function addTodayToDb() {
		$cnt = new Counter;
		$cnt->cnt_date = date('Y-m-d');
		$cnt->cnt_ip = $_SERVER['REMOTE_ADDR'];
		$save = $cnt->save();
		return $save;
	}

	private function getIpAddrPeriodTime($ip_addr) {
		return Counter::select('created_at')
			->where('cnt_ip', '=', $ip_addr)
			->orderBy('created_at', 'DESC')
			->limit(1)
			->get()
			->toArray();
	}
}
