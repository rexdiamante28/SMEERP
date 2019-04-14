<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function sanitize($in) {
	return addslashes(htmlspecialchars(strip_tags(trim($in))));
}

function generate_json($data) {
	header("access-control-allow-origin: *");
	header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
	header('Content-type: application/json');
	echo json_encode($data);
}

function today() {
	date_default_timezone_set('Asia/Manila');
	return date("Y-m-d");
}

function today_text() {
	date_default_timezone_set('Asia/Manila');
	return date("m/d/Y");
}

function time_only() {
	date_default_timezone_set('Asia/Manila');
	return date("G:i");
}

function todaytime() {
	date_default_timezone_set('Asia/Manila');
	return date("Y-m-d G:i:s");
}

function company_name() {
	echo "Lotto";
}

function company_name_php() { //please change the content same as company_name() function.
	return "Lotto";
}

function company_initial() {
	echo "Cloud Panda PH, Inc.";
}

function powered_by(){
	echo "Powered by <a href='http://www.cloudpanda.ph/' class='external' style='text-decoration:underline;'>Cloud Panda PH</a>";
}

function en_dec($action, $string) //used for token
{
	$output = false;

	$encrypt_method = "AES-256-CBC";
	$secret_key = 'CloudPandaPHInc';
	$secret_iv = 'TheDarkHorseRule';

	// hash
	$key = hash('sha256', $secret_key);

	// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	$iv = substr(hash('sha256', $secret_iv), 0, 16);

	if( $action == 'en' ) 
	{
	  $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
	  $output = base64_encode($output);
	}
	else if( $action == 'dec' )
	{
	  $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	}

	return $output;
}

function Generate_random_password() {
    $alphabet = "abcdefghijklmnopqrstuwxyz";
    $alphabetUpper = "ABCDEFGHIJKLMNOPQRSTUWXYZ";
    $alphabetNumber = "0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabetNumber) - 1; //put the length -1 in cache
    for ($i = 0; $i < 3; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n].$alphabetUpper[$n].$alphabetNumber[$n];
    }
    return implode($pass); //turn the array into a string
}

function get_offset($page,$limit)
{
	if($page <= 1)
	{
		return 0;
	}
	else
	{
		return (($page - 1) * $limit);
	}
}

function searchdate($date)
{
	if($date!='')
	{
		return substr($date,6,4).'-'.substr($date,0,2).'-'.substr($date,3,2);
	}
	
}

function deny_access()
{
	$response = array(
        'message' => 'Access Denied'
    );

    echo json_encode($response);
}


function display_val_text($form_empty,$value)
{
	if(!$form_empty)
	{
		return $value;
	}
	else
	{
		return "";
	}
}


function display_val_select($form_empty,$value,$current_option)
{
	if(!$form_empty)
	{
		if($value==$current_option)
		{
			return "selected";
		}
	}
	else
	{
		return "";
	}
}