<?php

namespace backend\controllers;
use Yii;
use yii\web\Controller;
use yii\web\Request;
use backend\models\Translate;
use backend\models\Pages;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
class TranslateController extends \yii\web\Controller
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
        ->orderBy(['page_id' => SORT_ASC])
        ->all(), 'page_id', 'page_name_th');

        $search = Yii::$app->request->queryParams;
    	$model = new Translate();
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
        $Translate = Translate::findOne(['translate_id' => $id]);
    	if (Yii::$app->request->isAjax) {
            if(Yii::$app->request->isPost){

                $Translate->translate_th = Yii::$app->request->post()['Translate']['translate_th'];
                $Translate->translate_en = Yii::$app->request->post()['Translate']['translate_en'];
            	$Translate->save();
            }
        }
    	return $this->renderAjax('update', [
            'Translate' => $Translate,
		]);
    }

}
