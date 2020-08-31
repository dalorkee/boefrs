<?php

namespace App\Http\Controllers;

use App\Exports;
use Illuminate\Http\Request;

class ExportsController extends Controller
{

	public function index() {
		return view('Exports.csv');
	}

	public function create() {

	}

	public function store(Request $request) {
		//
	}

	public function show(Exports $exports) {
		//
	}

	public function edit(Exports $exports) {

	}

	public function update(Request $request, Exports $exports) {
		//
	}

	public function destroy(Exports $exports) {
		//
	}
}
