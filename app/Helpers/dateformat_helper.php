<?php
    function get_date($strDate){


$DateThai = DateThai($strDate);
$DateEng = DateEng($strDate);
	$data=[
        'DateThai'=>$DateThai,
        'DateEng'=>$DateEng,

    ];
        return $data;

    }

    
function DateThai($strDate)

	{

		$date['Y'] = date("Y", strtotime($strDate)) + 543;

		$date['n'] = date("n", strtotime($strDate));//$strMonth

		$date['d'] = date("d", strtotime($strDate));//$strDay

        $date['H'] = date("H", strtotime($strDate));//$strHour

        $date['i'] = date("i", strtotime($strDate));//	$strMinute

        $date['s'] = date("s", strtotime($strDate));	//$strSeconds 

		$strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");

        $date['m'] = $strMonthCut[$date['n']];

		return $date;
	}
function DateEng($strDate)

	{

		$date['Y'] = date("Y", strtotime($strDate)) ;

		$date['n'] = date("n", strtotime($strDate));//$strMonth

		$date['d'] = date("d", strtotime($strDate));//$strDay

        $date['H'] = date("H", strtotime($strDate));//$strHour

        $date['i'] = date("i", strtotime($strDate));//	$strMinute

        $date['s'] = date("s", strtotime($strDate));	//$strSeconds 

		$strMonthCut = array("", "Jan.", "Feb.", "Mar.", "Apr.", "May.", "Jun.", "Jul.", "Aug.", "Sep.", "Oct.", "Nov.", "Dec.");

        $date['m'] = strtoupper($strMonthCut[$date['n']]);

		return $date;
	}