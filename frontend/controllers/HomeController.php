<?php
namespace frontend\controllers;
use yii;
use yii\helpers\ArrayHelper;

class HomeController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$this->layout = 'main';
        return $this->render('index');
    }

    public function actionLaw()
    {
        $this->layout = 'main';
    	return $this->render('law');
    }
    public function actionPrivacyPolicy()
    {
        $this->layout = 'main';
    	return $this->render('privacy-policy');
    }
}
