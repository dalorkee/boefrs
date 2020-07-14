<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\RapidGraph;
use App\MonthGraph;
use DB;
use App\HelperClass\Helper as CmsHelper;

class DashboardController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
		$this->middleware(['role:admin|hospital|lab']);
		$this->middleware('page_session');
		$this->middleware(function ($request, $next) {
			$this->user = Auth::user();
			return $next($request);
		});
	}

	public function index() {
		if (Auth::check()) {
			$hospcode = Auth::user()->hospcode;
		}
		$roleArr = auth()->user()->roles->pluck('name');
		$userRole = isset($roleArr[0]) ? $roleArr[0] : "";

		if ($userRole == 'admin') {
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

		} elseif ($userRole=='hospital' || $userRole=='lab') {
			$case_gen_code = DB::table('first_dash')->where('hospital',$hospcode)->sum('case_gen_code');
			$case_hos_send = DB::table('first_dash')->where('hospital',$hospcode)->sum('case_hos_send');
			$case_lab_confirm = DB::table('first_dash')->where('hospital',$hospcode)->sum('case_lab_confirm');
			$case_male = DB::table('first_dash')->where('hospital',$hospcode)->sum('case_male');
			$case_female = DB::table('first_dash')->where('hospital',$hospcode)->sum('case_female');

			/* rapid test data for graph */
			$rapid = RapidGraph::where('hospital', '=', $hospcode)->get();
			if (count($rapid) > 0) {
				$rapid = $rapid->keyBy('hospital')->toArray();
				$rapidResult['flua'] = $rapid[$hospcode]['rapid_flua'];
				$rapidResult['flub'] = $rapid[$hospcode]['rapid_flub'];
				$rapidResult['nagative'] = $rapid[$hospcode]['rapid_nagative'];
				$rapidResult['unknown'] = $rapid[$hospcode]['rapid_unknow'];

				/* anti */
				$antiResult['anti_arv'] = $rapid[$hospcode]['anti_arv'];
				$antiResult['anti_osel'] = $rapid[$hospcode]['anti_osel'];
				$antiResult['anti_tamiflu'] = $rapid[$hospcode]['anti_tamiflu'];
				$antiResult['anti_unknown'] = $rapid[$hospcode]['anti_unknow'];
			} else {
				$rapidResult = array('flua' => 0, 'flub' => 0, 'nagative' => 0, 'unknown' => 0);
				$antiResult = array('anti_arv'=>0, 'anti_osel'=>0, 'anti_tamiflu'=>0, 'anti_unknown'=>0);
			}

		}
		$case_all = $case_gen_code+$case_hos_send+$case_lab_confirm;
		// $donut_charts_arr = array(
		// 	array("label" => "Male" ,"symbol" => "M","y" =>$case_male),
		// 	array("label" => "Female" ,"symbol" => "F","y" =>$case_female)
		// );

		//Percent Male/Female
		$t_male = DB::table('z_rp_sex')->where('year_result','2020')->sum('male');
		$t_female = DB::table('z_rp_sex')->where('year_result','2020')->sum('female');
		$t_total = DB::table('z_rp_sex')->where('year_result','2020')->sum('totals');
		//dd($t_male,$t_female,$t_total);
		$percent_male = CmsHelper::Cal_percent($t_male,$t_total);
		$percent_female = CmsHelper::Cal_percent($t_female,$t_total);
		//dd($percent_male,$percent_female);
		$donut_charts_sex_arr = array(
			array("label" => "Male" ,"symbol" => "Male","y" =>$percent_male),
			array("label" => "Female" ,"symbol" => "Female","y" =>$percent_female)
		);


		//Age Group
		$datas_age['under1y'] = DB::table('z_rp_age_group')->where('year_result','2017')->sum('under1y');
		$datas_age['1-4y'] = DB::table('z_rp_age_group')->where('year_result','2017')->sum('1-4y');
		$datas_age['5-9y'] = DB::table('z_rp_age_group')->where('year_result','2017')->sum('5-9y');
		$datas_age['10-14y'] = DB::table('z_rp_age_group')->where('year_result','2017')->sum('10-14y');
		$datas_age['15-19y'] = DB::table('z_rp_age_group')->where('year_result','2017')->sum('15-19y');
		$datas_age['20-24y'] = DB::table('z_rp_age_group')->where('year_result','2017')->sum('20-24y');
		$datas_age['25-29y'] = DB::table('z_rp_age_group')->where('year_result','2017')->sum('25-29y');
		$datas_age['30-34y'] = DB::table('z_rp_age_group')->where('year_result','2017')->sum('30-34y');
		$datas_age['35-39y'] = DB::table('z_rp_age_group')->where('year_result','2017')->sum('35-39y');
		$datas_age['40-44y'] = DB::table('z_rp_age_group')->where('year_result','2017')->sum('40-44y');
		$datas_age['45-49y'] = DB::table('z_rp_age_group')->where('year_result','2017')->sum('45-49y');
		$datas_age['50-54y'] = DB::table('z_rp_age_group')->where('year_result','2017')->sum('50-54y');
		$datas_age['55-59y'] = DB::table('z_rp_age_group')->where('year_result','2017')->sum('55-59y');
		$datas_age['60-64y'] = DB::table('z_rp_age_group')->where('year_result','2017')->sum('60-64y');
		$datas_age['65up'] = DB::table('z_rp_age_group')->where('year_result','2017')->sum('65up');
		$datas_age['unknow'] = DB::table('z_rp_age_group')->where('year_result','2017')->sum('unknow');

		$sum_age_group = 0;

		foreach($datas_age as $key_age => $val_age){
			$sum_age_group += $val_age;
			$line_charts_age_group_arr[] = array("label"=> $key_age, "y"=> $val_age);
		}
		//dd($line_charts_age_group_arr);

		//Nation Graph
		$total_nation = DB::table('z_rp_nation')->where('year_result','2017')->sum('totals');

		$datas_nation['Thai'] = DB::table('z_rp_nation')->where('year_result','2020')->sum('thai');
		$datas_nation['Burmese'] = DB::table('z_rp_nation')->where('year_result','2020')->sum('burmese');
		$datas_nation['Lao'] = DB::table('z_rp_nation')->where('year_result','2020')->sum('lao');
		$datas_nation['Cambodian'] = DB::table('z_rp_nation')->where('year_result','2020')->sum('cambodian');
		$datas_nation['Other'] = DB::table('z_rp_nation')->where('year_result','2020')->sum('other');

		$sum_nation_group = 0;

		foreach($datas_nation as $key_nation => $val_nation){
			$sum_nation_group += $val_nation;

			$line_charts_nation_group_arr[] = array("label"=> $key_nation, "y"=> CmsHelper::Cal_percent($val_nation,$total_nation));
		}
		$datas_nation['nation_totals'] = DB::table('z_rp_nation')->where('year_result','2017')->sum('totals');




		return view('dashboard.index',
				compact(
					'case_gen_code',
					'case_hos_send',
					'case_lab_confirm',
					'case_all',
					'donut_charts_sex_arr',
					'line_charts_age_group_arr',
					'line_charts_nation_group_arr',
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
