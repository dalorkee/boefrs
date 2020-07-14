<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\RapidGraph;
use App\MonthGraph;
use DB;
use App\Provinces;
use App\HelperClass\Helper as CmsHelper;
use App\MonthMedian;

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
		$provinces = Provinces::all()->sortBy('province_name')->keyBy('province_id')->toArray();
		$list_year = CmsHelper::List_year();


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
		$t_male = DB::table('z_rp_sex')->sum('male');
		$t_female = DB::table('z_rp_sex')->sum('female');
		$t_total = DB::table('z_rp_sex')->sum('totals');
		//dd($t_male,$t_female,$t_total);
		$percent_male = CmsHelper::Cal_percent($t_male,$t_total);
		$percent_female = CmsHelper::Cal_percent($t_female,$t_total);
		//dd($percent_male,$percent_female);
		$donut_charts_sex_arr = array(
			array("label" => "Male" ,"symbol" => "Male","y" =>$percent_male),
			array("label" => "Female" ,"symbol" => "Female","y" =>$percent_female)
		);


		//Age Group
		$datas_age1 = DB::table('z_rp_age_group')->sum('under1y');
		$datas_age2 = DB::table('z_rp_age_group')->sum('1-4y');
		$datas_age['0-4y'] = $datas_age1+$datas_age2;
		$datas_age['5-9y'] = DB::table('z_rp_age_group')->sum('5-9y');
		$datas_age['10-14y'] = DB::table('z_rp_age_group')->sum('10-14y');
		$datas_age['15-19y'] = DB::table('z_rp_age_group')->sum('15-19y');
		$datas_age['20-24y'] = DB::table('z_rp_age_group')->sum('20-24y');
		$datas_age['25-29y'] = DB::table('z_rp_age_group')->sum('25-29y');
		$datas_age['30-34y'] = DB::table('z_rp_age_group')->sum('30-34y');
		$datas_age['35-39y'] = DB::table('z_rp_age_group')->sum('35-39y');
		$datas_age['40-44y'] = DB::table('z_rp_age_group')->sum('40-44y');
		$datas_age['45-49y'] = DB::table('z_rp_age_group')->sum('45-49y');
		$datas_age['50-54y'] = DB::table('z_rp_age_group')->sum('50-54y');
		$datas_age['55-59y'] = DB::table('z_rp_age_group')->sum('55-59y');
		$datas_age['60-64y'] = DB::table('z_rp_age_group')->sum('60-64y');
		$datas_age['65up'] = DB::table('z_rp_age_group')->sum('65up');
		$datas_age['unknow'] = DB::table('z_rp_age_group')->sum('unknow');

		$sum_age_group = 0;

		foreach($datas_age as $key_age => $val_age){
			$sum_age_group += $val_age;
			$line_charts_age_group_arr[] = array("label"=> $key_age, "y"=> $val_age);
		}
		//dd($line_charts_age_group_arr);

		//Nation Graph
		$total_nation = DB::table('z_rp_nation')->sum('totals');

		$datas_nation['Thai'] = DB::table('z_rp_nation')->sum('thai');
		$datas_nation['Burmese'] = DB::table('z_rp_nation')->sum('burmese');
		$datas_nation['Lao'] = DB::table('z_rp_nation')->sum('lao');
		$datas_nation['Cambodian'] = DB::table('z_rp_nation')->sum('cambodian');
		$datas_nation['Other'] = DB::table('z_rp_nation')->sum('other');

		$sum_nation_group = 0;

		foreach($datas_nation as $key_nation => $val_nation){
			$sum_nation_group += $val_nation;

			$line_charts_nation_group_arr[] = array("label"=> $key_nation, "y"=> CmsHelper::Cal_percent($val_nation,$total_nation));
		}
		$datas_nation['nation_totals'] = DB::table('z_rp_nation')->sum('totals');

		/** Median **/
		$year_now = date('Y');


    $year_now = date('Y');
		$year_last_med = $year_now-1;
		$year_back_3 = $year_now-3;

		$arr_month = array("01" => "Jan" , "02" => "Feb", "03" => "Mar", "04" => "Apr",
											 "05" => "May", "06" => "Jun", "07" => "Jul", "08" => "Aug",
											 "09" => "Sep", "10" => "Oct", "11" => "Nov", "12" => "Dec");

		for($i=1; $i<=12; $i++){
			$result1 = MonthMedian::selectRaw('year_result,month_result,sum(totals) AS totals')
			->whereBetween('year_result',[$year_back_3,$year_last_med])
			->where('month_result',str_pad($i,2,"0",STR_PAD_LEFT))
			->groupBy('year_result','month_result')
			->orderBy('totals','ASC')
			->limit(1,1)
			->first();

			$data_three_year_median[] = array("label" => $arr_month[str_pad($i,2,"0",STR_PAD_LEFT)],"y" => $result1['totals']);

		}

		for($i=1; $i<=12; $i++){
			$result2 = MonthMedian::selectRaw('year_result,month_result,sum(totals) AS totals')
			->where('year_result',$year_now)
			->where('month_result',$i)
			->groupBy('year_result','month_result')
			->orderBy('totals','ASC')
			->first();

		 $arr_now_year_median[] = $result2;
		}

		//dd($arr_now_year_median);

		foreach($arr_now_year_median as $val){
			$pt_data[$val['month_result'] ?? ''] = $val['totals'] ?? '';
		}
		//
		// dd($pt_data);

		foreach ($arr_month as $key => $value) {
			if (array_key_exists($key, $pt_data)) {
				$data_now_year_median[$arr_month[$key]] = $pt_data[$key];
			}else{
				$data_now_year_median[$arr_month[$key]] = 0;
			}
		}
		/**** Collation Data Now Median Graph ****/
		foreach ($data_now_year_median as $key1 => $val1){
			$data_now_median[] = array("label" => $key1 , "y" => $val1);
		}
			//dd($data_now_median);
		/** Median **/



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
					'antiResult',
					'provinces',
					'list_year',
					'data_three_year_median',
					'data_now_median'
				)
		);
	}


	public function index_post(Request $request)
	{
		dd($request);
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
