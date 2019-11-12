<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

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
		/*
		$prov = parent::provinces();
		$provinces = $prov->keyBy('province_id');
		$provinces->all();
		$request->session()->put('provinces', $provinces);
		*/

		$roleArr = auth()->user()->getRoleNames();
		//$roleArr = auth()->user()->roles()->pluck('name');
		//$roleArr = Auth::user()->roles()->pluck('name');
		$userRole = $roleArr[0];
		if ($userRole == 'admin') {
			return redirect()->route('dashboard.index');
		} elseif ($userRole == 'hospital' || $userRole == 'lab') {
			return redirect()->route('dashboard.index');
		} else {
			return redirect()->route('logout');
		}
	}
}
