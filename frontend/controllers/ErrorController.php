<?php

namespace frontend\controllers;

class ErrorController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('404');
    }

    public function action404()
    {
        return $this->render('404');
    }

}
