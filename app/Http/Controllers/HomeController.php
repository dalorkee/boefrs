<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Session;

class HomeController extends BoeFrsController
{
	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware(['role:admin|hospital|lab']);
//		$this->middleware(['permission:manageuser']);
	}

	/**
	* Show the application dashboard.
	*
	* @return \Illuminate\Contracts\Support\Renderable
	*/
	public function index(Request $request)
	{
		$user_hosp = parent::hospitalByCode(auth()->user()->hospcode);
		$user_hosp = $user_hosp->pluck('hosp_name')->all();
		Session::put('user_hospital_name', $user_hosp[0]);

		//$roleArr = auth()->user()->getRoleNames()->all();
		$roleArr = auth()->user()->roles->pluck('name');
		$userRole = $roleArr[0];
		Session::put('user_role_name', $userRole);

		if ($userRole == 'admin') {
			return redirect()->route('dashboard.index');
		} elseif ($userRole == 'hospital' || $userRole == 'lab') {
			return redirect()->route('dashboard.index');
		} else {
			return redirect()->route('logout');
		}
	}
}
