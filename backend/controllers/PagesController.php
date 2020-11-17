<?php

namespace backend\controllers;
use Yii;
use yii\web\Controller;
use yii\web\Request;
use backend\models\Pages;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
class PagesController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index','update'],
                        'allow' => true,
                        'roles' => ['@'], // @ = login, ? = no login
                    ],
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        $Pages = ArrayHelper::map(Pages::find()
        ->andWhere(['<>', 'page_id', 0])
        ->orderBy(['page_id' => SORT_ASC])
        ->all(), 'page_id', 'page_name_th');

        $search = Yii::$app->request->queryParams;
    	$model = new Pages();
        $dataProvider = $model->search($search);
        if(Yii::$app->request->isPjax){

        	if(!empty($search['Pages']['pageSize'])){
        		$dataProvider->pagination->pageSize = $search['Pages']['pageSize'];
        	}
        	return $this->renderPartial('index', [
        		'model' => $model,
            	'dataProvider' => $dataProvider,
            	'search' => $search,
                'Pages' => $Pages
        	]);
        }else{
        	return $this->render('index', [
        		'model' => $model,
            	'dataProvider' => $dataProvider,
            	'search' => $search,
                'Pages' => $Pages
        	]);

        }
    }
    public function actionUpdate()
    {
    	$id = Yii::$app->request->get('id');
        $Pages = Pages::findOne(['page_id' => $id]);
    	if (Yii::$app->request->isAjax) {
            if(Yii::$app->request->isPost){

                $Pages->meta_tag_title_th = Yii::$app->request->post()['Pages']['meta_tag_title_th'];
                $Pages->meta_tag_title_en = Yii::$app->request->post()['Pages']['meta_tag_title_en'];
                $Pages->meta_tag_description_th = Yii::$app->request->post()['Pages']['meta_tag_description_th'];
                $Pages->meta_tag_description_en = Yii::$app->request->post()['Pages']['meta_tag_description_en'];
                $Pages->meta_tag_keywords_th = Yii::$app->request->post()['Pages']['meta_tag_keywords_th'];
                $Pages->meta_tag_keywords_en = Yii::$app->request->post()['Pages']['meta_tag_keywords_en'];
            	$Pages->save();
            }
        }
    	return $this->renderAjax('update', [
            'Pages' => $Pages,
		]);
    }

}
