<?php 
$cal_months = array('jan','feb','march','apr','may','june','jul','aug','sept','oct','nov','dec');
$cal_days = array('sun','mon','tues','wed','thus','fri','sat');
$cal_dates = array();
$odd = '1';$even = '0';

if($even==0)
{
	for($i=1;$i<=31;$i++)
	{
		$cal_dates['jan'][] = $i;
		$cal_dates['march'][] = $i;
		$cal_dates['may'][] = $i;
		$cal_dates['july'][] = $i;
		$cal_dates['aug'][] = $i;
		$cal_dates['oct'][] = $i;
		$cal_dates['dec'][] = $i;
	}
}
if($cal_months[1]=='feb')
{
	for($i=1;$i<=28;$i++)
	{
		$cal_dates['feb'][]=$i;
	}
}
if($odd==1)
{
	for($i=1;$i<=30;$i++)
	{
		$cal_dates['apr'][] = $i;
		$cal_dates['jun'][] = $i;
		$cal_dates['sept'][] = $i;
		$cal_dates['nov'][] = $i;		
	}
}
$pieces = array_chunk($cal_dates['feb'],7);
//echo "<pre>";print_r($pieces);die;
//echo "<pre>";print_r($pieces[0]);echo "-----------";echo "<pre>";print_r($pieces[1]);die;
//echo count($pieces);die;
 ?>