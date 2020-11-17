<?php
namespace frontend\components;

use Yii;
use yii\base\Component;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

class CoreFunctions extends Component
{
	public function getIP()
	{
		$ipaddress = '';
	    if (isset($_SERVER['HTTP_CLIENT_IP']))
	        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    else if(isset($_SERVER['HTTP_X_FORWARDED']))
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
	        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	    else if(isset($_SERVER['HTTP_FORWARDED']))
	        $ipaddress = $_SERVER['HTTP_FORWARDED'];
	    else if(isset($_SERVER['REMOTE_ADDR']))
	        $ipaddress = $_SERVER['REMOTE_ADDR'];
	    else
	        $ipaddress = 'UNKNOWN';
	    return $ipaddress;
	}

	public function getUTM()
	{
		$getUTM =  explode("/", Yii::$app->request->url);
		$getUTM = end($getUTM);
		
		$getSource = array();
		$source = preg_match('/utm_source=([^\s\&]+)/', $getUTM, $getSource);

		$getMedium = array();
		$medium = preg_match('/utm_medium=([^\s\&]+)/', $getUTM, $getMedium);

		$getCampaign = array();
		$campaign = preg_match('/utm_campaign=([^\s\&]+)/', $getUTM, $getCampaign);

		$utm_source = (!empty($getSource[1]) ? $getSource[1] : null);
		$utm_medium = (!empty($getMedium[1]) ? $getMedium[1] : null);
		$utm_campaign = (!empty($getCampaign[1]) ? $getCampaign[1] : null);

		if($utm_source!="" OR $utm_medium!="" OR $utm_campaign!=""){
			Yii::$app->session['utm_source'] = urldecode($utm_source);
			Yii::$app->session['utm_medium'] = urldecode($utm_medium);
			Yii::$app->session['utm_campaign'] = urldecode($utm_campaign);
		}
		$utm = array(
		    'utm_source' => Yii::$app->session['utm_source'],
		    'utm_medium' => Yii::$app->session['utm_medium'],
		    'utm_campaign' => Yii::$app->session['utm_campaign']
		);
		return (object)$utm;
	}

	public function getDateThaiFull($date)
    {
        $strYear = date("Y",strtotime($date))+543;
        $strMonth= date("n",strtotime($date));
        $strDay= date("j",strtotime($date));
        $strHour= date("H",strtotime($date));
        $strMinute= date("i",strtotime($date));
        $strSeconds= date("s",strtotime($date));
        $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
        $strMonthThai=$strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";
    }
    public function getDateTimeThaiFull($date)
    {
        $strYear = date("Y",strtotime($date))+543;
        $strMonth= date("n",strtotime($date));
        $strDay= date("j",strtotime($date));
        $strHour= date("H",strtotime($date));
        $strMinute= date("i",strtotime($date));
        $strSeconds= date("s",strtotime($date));
        $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
        $strMonthThai=$strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear $strHour:$strMinute:$strSeconds";
    }
}