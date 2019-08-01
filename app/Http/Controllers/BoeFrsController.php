<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BoeFrsController extends Controller
{
	public function getSymptoms() {
		return DB::connection('mysql')->table('symptoms')->get();
	}
}
