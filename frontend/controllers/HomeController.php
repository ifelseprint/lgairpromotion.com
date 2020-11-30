<?php
namespace frontend\controllers;
use yii;
use yii\helpers\ArrayHelper;

class HomeController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->redirect(['cleanandcoolpromotion/index']);
    }
}
