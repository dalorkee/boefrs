<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Patients;
use Session;

class LabController extends BoeFrsController
{
	public function __construct() {
		parent::__construct();
		$this->middleware('auth');
		$this->middleware(['role:admin|hospital|lab']);
	}

	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index() {
		$roleArr = auth()->user()->getRoleNames();
		if ($roleArr[0] == 'admin') {
			$patients = Patients::where('lab_status', '!=', 'new')
				->whereNull('deleted_at')->get();
		} elseif ($roleArr[0] == 'hospital' || $roleArr[0] == 'lab') {
			$hospcode = auth()->user()->hospcode;
			$patients = Patients::where('ref_user_hospcode', '=', $hospcode)
				->where('lab_status', '!=', 'new')
				->whereNull('deleted_at')
				->get();
		} else {
			return redirect()->route('logout');
		}
		return view(
			'lab.index',
			[
				'titleName' => $this->title_name,
				'patients' => $patients
			]
		);
	}

	/**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function create(Request $request) {
		$symptoms = parent::symptoms();
		$patient = Patients::where('id', '=', $request->id)
			->where('lab_status', '!=', 'new')
			->whereNull('deleted_at')->get();
		return view('lab.create',
			[
				'titleName'=>$this->title_name,
				'symptoms'=>$symptoms,
				'patient'=>$patient
			]
		);
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
