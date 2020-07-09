<?php
namespace App\HelperClass;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Cache;

    class Helper{
        function __construct()
        {
            //echo 'test';
        }


        public static function DateThai($strDate){
          if($strDate=='0000-00-00' || $strDate=='' || $strDate==null) return '-';
              $strYear = date("Y",strtotime($strDate))+543;
              $strMonth= date("n",strtotime($strDate));
              $strDay= date("j",strtotime($strDate));
              $strHour= date("H",strtotime($strDate));
              $strMinute= date("i",strtotime($strDate));
              $strSeconds= date("s",strtotime($strDate));
              $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
              $strMonthThai=$strMonthCut[$strMonth];
          return "$strDay $strMonthThai $strYear";
        }

        public static function MonthThai($strDate){
          if($strDate=='0000-00-00' || $strDate=='' || $strDate==null) return '-';
              $strYear = date("Y",strtotime($strDate))+543;
              $strMonth= date("n",strtotime($strDate));
              $strDay= date("j",strtotime($strDate));
              $strHour= date("H",strtotime($strDate));
              $strMinute= date("i",strtotime($strDate));
              $strSeconds= date("s",strtotime($strDate));
              $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
              $strMonthThai=$strMonthCut[$strMonth];
          return "$strMonthThai $strYear";
        }

        public static function Date_Format_BC_To_AD($strDate){
          if(empty($strDate)) return false;
            $bc_year = explode("/",$strDate);
            $day = $bc_year['0'];
            $month = $bc_year['1'];
            $year = $bc_year['2']-543;
          return $year.'-'.$month.'-'.$day;
        }

        public static function Date_Format_ฺAD_To_BC($strDate){
          if(empty($strDate)) return false;
          $ad_year = explode("-",$strDate);
          $day = $ad_year['2'];
          $month = $ad_year['1'];
          $year = $ad_year['0']+543;
          return $day.'/'.$month.'/'.$year;
        }
        public static function Date_Format_Custom($strDate){
          if(empty($strDate)) return false;
            $bc_year = explode("-",($strDate));
            $day = $bc_year['2'];
            $month = $bc_year['1'];
            $year = $bc_year['0'];
          return $year.'-'.$month.'-'.$day;
        }
        public static function Status_Icon_ListDetect($status){

            if($status=='0'){
              $html = '<span class="label label-warning">Pending</span>';
            }elseif($status=='1'){
              $html = '<span class="label label-danger">Outbreak</span>';
            }elseif($status=='2'){
              $html = '<span class="badge bg-success">Normal</span>';
            }else{
              $html = '<span class="badge bg-info">N/A</span>';
            }

            echo $html;
        }


        public static function List_Amphur(){
          //$datas = DB::table('c_tumbol')->select('tum_code','tum_name')->get();

          $datas = Cache::rememberForever('c_tumbol', function()
          {
              return DB::table('c_tumbol')->select('tum_code','tum_name')->get();
          });

          //dd($datas);

          foreach($datas as $data){
            $arr[$data->tum_code] = $data->tum_name;
          }
          return $arr;
        }

}
