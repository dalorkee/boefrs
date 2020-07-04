<?php
function DateThai($strDate)
{
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

$current_date = DateThai(date('Y-m-d'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>LABResult-</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
@font-face{
 font-family:  'THSarabunNew';
 font-style: normal;
 font-weight: normal;
 src: url("{{ asset('fonts/THSarabunNew.ttf') }}") format('truetype');
}
@font-face{
 font-family:  'THSarabunNew';
 font-style: normal;
 font-weight: bold;
 src: url("{{ asset('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
}
@font-face{
 font-family:  'THSarabunNew';
 font-style: italic;
 font-weight: normal;
 src: url("{{ asset('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
}
@font-face{
 font-family:  'THSarabunNew';
 font-style: italic;
 font-weight: bold;
 src: url("{{ asset('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
}
body{
 font-family: "THSarabunNew";
 font-size: 16px;
}
@page {
      size: A4;
      padding: 15px;
    }
    @media print {
      html, body {
        width: 210mm;
        height: 297mm;
        /*font-size : 16px;*/
      }
    }
.tblresult {
  border: 1px solid black;
}
 table { border-collapse: collapse; }
</style>
</head>
<body>

<table style="width: 100%;">
<tbody>
<tr>
<td style="width: 100%; ">
<table style="width: 675px;">
<tbody>
<tr>
<td style="width: 253px;" valig="top"><img src="{{ url('assets/images/dmslogo.png') }}" width="220px" height="140px"></td>
<td style="width: 272px;">&nbsp;</td>
<td style="width: 149px;" align="right">&nbsp;ลำดับที่ 63-01119</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="width: 100%;" align="center">รายงานผลการตรวจวิเคราะห์<br />สถาบันวิจัยวิทยาศาสตร์สาธารณสุข กรมวิทยาศาสตร์การแพทย์ กระทรวงสาธารณสุข<br />ถนนติวานนท์ อำเภอเมือง จังหวัดนนทบุรี 11000&nbsp;</td>
</tr>

<tr>
<td style="width: 100%;">
  <hr size=3 noshadow>
<table style="width: 677px;">
<tbody>
<tr style="height: 23px;">
<td style="width: 262px; height: 23px;">เลขที่ใบกำกับ:</td>
<td style="width: 414px; height: 23px;">&nbsp;</td>
</tr>
<tr style="height: 23px;">
<td style="width: 262px; height: 23px;">วันที่รับตัวอย่าง:</td>
<td style="width: 414px; height: 23px;">&nbsp;</td>
</tr>
<tr style="height: 23px;">
<td style="width: 262px; height: 23px;">ผู้ตรวจ:</td>
<td style="width: 414px; height: 23px;">&nbsp;</td>
</tr>
<tr style="height: 23px;">
<td style="width: 262px; height: 23px;">วัตถุประสงค์:</td>
<td style="width: 414px; height: 23px;">&nbsp;</td>
</tr>
<tr style="height: 23px;">
<td style="width: 262px; height: 23px;">ชื่อรายการทดสอบ:</td>
<td style="width: 414px; height: 23px;">&nbsp;</td>
</tr>
<tr style="height: 23px;">
<td style="width: 262px; height: 23px;">วิธีการทดสอบ:</td>
<td style="width: 414px; height: 23px;">&nbsp;</td>
</tr>
<tr style="height: 23px;">
<td style="width: 262px; height: 23px;">ผลการวิเคราะห์:</td>
<td style="width: 414px; height: 23px;">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="width: 100%;">
<table style="width: 677px;" border="1" align="center" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC">
<tbody>
<tr >
<td style="width: 149px; ">&nbsp;หมายเลขวิเคราะห์</td>
<td style="width: 327px;" align="center">&nbsp;รายละเอียดสิ่งส่งตรวจ</td>
<td style="width: 200px;" align="center">ผลการตรวจวิเคราะ์</td>
</tr>
<tr>
<td style="width: 149px;">&nbsp;13-63-01462</td>
<td style="width: 327px;">นางมีนะ เพียวเซกู่<br />อายุ 54 ปี<br />ชนิดตัวอย่าง Throat swab</td>
<td style="width: 200px;">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="width: 100%;">
<table style="width: 700px;">
<tbody>
<tr>
<td style="width: 350px;" align="center">......................................................... ผู้วิเคราะห์<br />(นายภากร ภิรมย์ทอง)<br />นักวิทยาศาสตร์การแพทย์<br /> {{ $current_date }}</td>
<td style="width: 350px;" align="center">......................................................... ผู้รับรองรายงานผล<br />(นางสาวสิริภาภรณ์ ผุยกัน)<br />นักวิทยาศาสตร์การแพทย์ชำนาญการ<br /> {{ $current_date }}</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!-- DivTable.com -->
</body>
</html>
