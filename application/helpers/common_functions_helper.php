<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_personality_string'))
{
    function get_personality_string($pers)
	{
		$extravert = $pers['E'];
		if ($extravert >= 50) {
			$ei = "Extravert: " . round($extravert,1) . "%";
			$data['type'] = "E";
		}
		else {
			$ei = "Introvert: " . round((100 - $extravert),1) . "%";
			$data['type'] = "I";
		}
		$intuitive = $pers['N'];
		if ($intuitive >= 50) {
			$ns = "Intuitive: " . round($intuitive,1) . "%";
			$data['type'] = $data['type'] . "N"; 
		}
		else {
			$ns = "Sensing: " . round((100 - $intuitive),1) . "%";
			$data['type'] = $data['type'] . "S"; 
		}
		$thinking = $pers['T'];
		if ($thinking >= 50) {
			$tf = "Thinking: " . round($thinking,1) . "%";
			$data['type'] = $data['type'] . "T"; 
		}
		else {
			$tf = "Feeling: " . round((100 - $thinking),1) . "%";
			$data['type'] = $data['type'] . "F"; 
		}
		$judging = $pers['J'];
		if ($judging >= 50) {
			$jp = "Judging: " . round($judging,1) . "%";
			$data['type'] = $data['type'] . "J"; 
		}
		else {
			$jp = "Percieving: " . round((100 - $judging), 1) . "%";
			$data['type'] = $data['type'] . "P"; 
		}
		$data['percentage'] = $ei . "<br />" . $ns . "<br />" . $tf . "<br />" . $jp;
		
		return $data;
	}
}