<?php

namespace backend\controllers;
use Yii;
use yii\web\Controller;
use backend\models\JobsForm;
use yii\helpers\Url;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
class JobsFormController extends \yii\web\Controller
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

        $jobs = ArrayHelper::map(\common\models\Jobs::find()
        ->orderBy(['jobs_name_th' => SORT_ASC])
        ->all(), 'jobs_id', 'jobs_name_th');

    	$model = new JobsForm();
        $dataProvider = $model->search($search);
        if(Yii::$app->request->isPjax){

        	if(!empty($search['JobsForm']['pageSize'])){
        		$dataProvider->pagination->pageSize = $search['JobsForm']['pageSize'];
        	}
        	return $this->renderPartial('index', [
        		'model' => $model,
            	'dataProvider' => $dataProvider,
                'jobs' => $jobs,
            	'search' => $search
        	]);
        }else{
        	return $this->render('index', [
        		'model' => $model,
            	'dataProvider' => $dataProvider,
                'jobs' => $jobs,
            	'search' => $search
        	]);

        }
    }
    public function actionView()
    {
        $id = Yii::$app->request->get('id');
        $JobsForm = JobsForm::findOne(['jobs_form_id' => $id]);
        return $this->renderAjax('view', [
            'JobsForm' => $JobsForm
        ]);
    }
}
