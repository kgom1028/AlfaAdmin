<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @desc        General Helper.
 * @author      Zhongge Han for Second Opinion
 * @copyright   2014
 * @version     1.0
 */
 
 
// Get SQL Result
function get_sql_result($sql)
{
    $CI =& get_instance(); 
	$query = $CI->db->query($sql);
	return $query->result();
}

function get_sql_result_arr($sql)
{
	$result = get_sql_result($sql);
	if($result)
	{
		$arr = json_decode(json_encode($result), true);	
		return $arr;
	}else
	{
		return $result;
	}
}
function get_sql_query($sql)
{
    $CI =& get_instance(); 
	$query = $CI->db->query($sql);
}
function get_sql_value($sql)
{
    $CI =& get_instance(); 
	$query = $CI->db->query($sql);
	$result =  $query->result();
	if(count($result) <= 0) return false;
	return $result[0];
}
function get_sql_array($sql)
{
	$result = get_sql_value($sql);
	if($result)
	{
		$arr = json_decode(json_encode($result), true);	
		return $arr;
	}else
	{
		return $result;
	}
	
	
}
function cut_str($str, $l = null, $s = 0) {
	$len = strlen(utf8_decode($str));
	$temp = uc_substr($str, $s, $l);
	// 한두개 문자가 잘리우면 그대로 출력한다.
	if ($len < strlen(utf8_decode($temp)) + 2) return $str;
	// 3개 이상의 문자가 잘리우면 잘라서 출력한다.
	return $temp. "...";
}
function uc_substr($str, $s, $l = null) {
	return join("", array_slice(
		preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY), $s, $l));
}
function is_login()
{
	if(!isset($_SESSION['USERSESS']) || $_SESSION['USERSESS']['user_id'] == "")
		return false;
	return true;
}
function tolog($data)
{		
	$data = "[STOCK][IP:".$_SERVER['REMOTE_ADDR']."]".$data;
	log_message('error', $data);
}
?>