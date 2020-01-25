<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\RapidGraph;
use App\MonthGraph;
use DB;

class DashboardController extends Controller
{
	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/

	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware(['role:admin|hospital|lab']);
		//$this->middleware(['permission:manageuser']);
		$this->middleware('page_session');
		$this->middleware(function ($request, $next) {
				$this->user = Auth::user();
				return $next($request);
		});
	}

	public function index()
	{
		if (Auth::check()){
			$hospcode = Auth::user()->hospcode;
		}
		$roleArr = auth()->user()->roles->pluck('name');
		$userRole = isset($roleArr[0]) ? $roleArr[0] : "";

		if($userRole=='admin') {
			$case_gen_code = DB::table('first_dash')->sum('case_gen_code');
			$case_hos_send = DB::table('first_dash')->sum('case_hos_send');
			$case_lab_confirm = DB::table('first_dash')->sum('case_lab_confirm');
			$case_male = DB::table('first_dash')->sum('case_male');
			$case_female = DB::table('first_dash')->sum('case_female');

			/* month graph */
			$month_graph = MonthGraph::all();
			$month_graph = $month_graph->keyBy('hospital')->toArray();

			/* rapid test data for graph */
			$rapid = RapidGraph::all();
			$rapid = $rapid->keyBy('hospital')->toArray();
			$rapidResult = array('flua'=>0, 'flub'=>0, 'nagative'=>0, 'unknown'=>0);
			foreach ($rapid as $key => $value) {
				$rapidResult['flua'] += $value['rapid_flua'];
				$rapidResult['flub'] += $value['rapid_flub'];
				$rapidResult['nagative'] += $value['rapid_nagative'];
				$rapidResult['unknown'] += $value['rapid_unknow'];
			}

			$antiResult = array('anti_arv'=>0, 'anti_osel'=>0, 'anti_tamiflu'=>0, 'anti_unknown'=>0);
			foreach ($rapid as $key => $value) {
				$antiResult['anti_arv'] += $value['anti_arv'];
				$antiResult['anti_osel'] += $value['anti_osel'];
				$antiResult['anti_tamiflu'] += $value['anti_tamiflu'];
				$antiResult['anti_unknown'] += $value['anti_unknow'];
			}


		} elseif($userRole=='hospital' || $userRole=='lab') {
			$case_gen_code = DB::table('first_dash')->where('hospital',$hospcode)->sum('case_gen_code');
			$case_hos_send = DB::table('first_dash')->where('hospital',$hospcode)->sum('case_hos_send');
			$case_lab_confirm = DB::table('first_dash')->where('hospital',$hospcode)->sum('case_lab_confirm');
			$case_male = DB::table('first_dash')->where('hospital',$hospcode)->sum('case_male');
			$case_female = DB::table('first_dash')->where('hospital',$hospcode)->sum('case_female');

			/* rapid test data for graph */
			$rapid = RapidGraph::where('hospital', '=', $hospcode)->get();
			$rapid = $rapid->keyBy('hospital')->toArray();
			$rapidResult = array('flua'=>0, 'flub'=>0, 'nagative'=>0, 'unknown'=>0);
			$rapidResult['flua'] = $rapid[$hospcode]['rapid_flua'];
			$rapidResult['flub'] = $rapid[$hospcode]['rapid_flub'];
			$rapidResult['nagative'] = $rapid[$hospcode]['rapid_nagative'];
			$rapidResult['unknown'] = $rapid[$hospcode]['rapid_unknow'];

			/* anti */
			$antiResult = array('anti_arv'=>0, 'anti_osel'=>0, 'anti_tamiflu'=>0, 'anti_unknown'=>0);
			$antiResult['anti_arv'] = $rapid[$hospcode]['anti_arv'];
			$antiResult['anti_osel'] = $rapid[$hospcode]['anti_osel'];
			$antiResult['anti_tamiflu'] = $rapid[$hospcode]['anti_tamiflu'];
			$antiResult['anti_unknown'] = $rapid[$hospcode]['anti_unknow'];

		}
		$case_all = $case_gen_code+$case_hos_send+$case_lab_confirm;
		$donut_charts_arr = array(
													array("label" => "Male" ,"symbol" => "M","y" =>$case_male),
													array("label" => "Female" ,"symbol" => "F","y" =>$case_female)
												);
		return view('dashboard.index',
					compact(
						'case_gen_code',
						'case_hos_send',
						'case_lab_confirm',
						'case_all',
						'donut_charts_arr',
						'rapidResult',
						'antiResult'
					)
				);
	}

	/**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function create()
	{

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

		public function Dashboard_Card(){

		}
}
