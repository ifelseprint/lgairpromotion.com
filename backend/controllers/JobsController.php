<?php

namespace backend\controllers;
use Yii;
use yii\web\Controller;
use backend\models\Jobs;
use yii\helpers\Url;
use yii\filters\AccessControl;
class JobsController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index','create','update','delete'],
                        'allow' => true,
                        'roles' => ['@'], // @ = login, ? = no login
                    ],
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        $search = Yii::$app->request->queryParams;
    	$model = new Jobs();
        $dataProvider = $model->search($search);
        if(Yii::$app->request->isPjax){

        	if(!empty($search['Jobs']['pageSize'])){
        		$dataProvider->pagination->pageSize = $search['Jobs']['pageSize'];
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
    public function actionCreate()
    {
    	$Jobs = new Jobs();
    	if (Yii::$app->request->isAjax) {
            if(Yii::$app->request->isPost){
            	$save = $this->save($Jobs,null,null);
            }
        }
        return $this->renderAjax('create', [
			'Jobs' => $Jobs
		]);
    }

    public function actionUpdate()
    {
    	$id = Yii::$app->request->get('id');
    	$Jobs = Jobs::findOne(['jobs_id' => $id]);
    	if (Yii::$app->request->isAjax) {
            if(Yii::$app->request->isPost){
                $save = $this->save($Jobs,null,$id);
            }
        }
    	return $this->renderAjax('update', [
			'Jobs' => $Jobs
		]);
    }

    public function actionDelete()
    {
    	$id = Yii::$app->request->get('id');
    	$Jobs = Jobs::find()
		->where(['jobs_id'=>$id])
		->one()
		->delete();

		$model = new Jobs();
		$search = Yii::$app->request->queryParams;
        $dataProvider = $model->search($search);
		return $this->render('index', [
            'model' => $model,
            'dataProvider' => $dataProvider,
            'search' => $search
        ]);
    }
    public function save($model,$model2=null,$id=null)
    {
        // Jobs
        $model->jobs_name_th = Yii::$app->request->post()['Jobs']['jobs_name_th'];
        $model->jobs_name_en = Yii::$app->request->post()['Jobs']['jobs_name_en'];
        $model->jobs_content_th = Yii::$app->request->post()['Jobs']['jobs_content_th'];
        $model->jobs_content_en = Yii::$app->request->post()['Jobs']['jobs_content_en'];

        $model->meta_tag_title_th = Yii::$app->request->post()['Jobs']['meta_tag_title_th'];
        $model->meta_tag_title_en = Yii::$app->request->post()['Jobs']['meta_tag_title_en'];
        $model->meta_tag_description_th = Yii::$app->request->post()['Jobs']['meta_tag_description_th'];
        $model->meta_tag_description_en = Yii::$app->request->post()['Jobs']['meta_tag_description_en'];
        $model->meta_tag_keywords_th = Yii::$app->request->post()['Jobs']['meta_tag_keywords_th'];
        $model->meta_tag_keywords_en = Yii::$app->request->post()['Jobs']['meta_tag_keywords_en'];

        $model->is_active = Yii::$app->request->post()['Jobs']['is_active'];
        $model->save();
    }
}
