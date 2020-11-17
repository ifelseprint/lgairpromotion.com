<?php
namespace frontend\controllers;
use yii;
use yii\helpers\ArrayHelper;
class LawController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$this->layout = 'inside';
        return $this->render('index');
    }

}
