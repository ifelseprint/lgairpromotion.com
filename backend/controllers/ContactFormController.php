<?php

namespace backend\controllers;
use Yii;
use yii\web\Controller;
use backend\models\ContactForm;
use yii\helpers\Url;
use yii\filters\AccessControl;
class ContactFormController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index','view'],
                        'allow' => true,
                        'roles' => ['@'], // @ = login, ? = no login
                    ],
                ],
            ],
        ];
    }
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    public function actionIndex()
    {
        $search = Yii::$app->request->queryParams;
    	$model = new ContactForm();
        $dataProvider = $model->search($search);
        if(Yii::$app->request->isPjax){

        	if(!empty($search['ContactForm']['pageSize'])){
        		$dataProvider->pagination->pageSize = $search['ContactForm']['pageSize'];
        	}
        	return $this->renderPartial('index', [
        		'model' => $model,
            	'dataProvider' => $dataProvider,
            	'search' => $search
        	]);
        }else{
        	return $this->render('index', [
        		'model' => $model,
            	'dataProvider' => $dataProvider,
            	'search' => $search
        	]);

        }
    }
    public function actionView()
    {
        $id = Yii::$app->request->get('id');
        $ContactForm = ContactForm::findOne(['contact_form_id' => $id]);
        // print_r($ContactForm);
        // exit;
        return $this->renderAjax('view', [
            'ContactForm' => $ContactForm
        ]);
    }
}
