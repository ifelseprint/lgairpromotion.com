<?php

namespace backend\controllers;
use Yii;
use yii\web\Controller;
use yii\web\Request;
use backend\models\Promotion;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
class PromotionController extends \yii\web\Controller
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
    	$model = new Promotion();
        $dataProvider = $model->search($search);
        if(Yii::$app->request->isPjax){

        	if(!empty($search['Promotion']['pageSize'])){
        		$dataProvider->pagination->pageSize = $search['Promotion']['pageSize'];
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
    	$Promotion = new Promotion();
    	if (Yii::$app->request->isAjax) {
            if(Yii::$app->request->isPost){
                $save = $this->save($Promotion,null);
            }
        }
        return $this->renderAjax('create', [
			'Promotion' => $Promotion,
		]);
    }

    public function actionUpdate()
    {
    	$id = Yii::$app->request->get('id');
        $Promotion = Promotion::findOne(['promotion_id' => $id]);
    	if (Yii::$app->request->isAjax) {
            if(Yii::$app->request->isPost){
                $save = $this->save($Promotion,$id);
            }
        }
    	return $this->renderAjax('update', [
			'Promotion' => $Promotion,
		]);
    }

    public function actionDelete()
    {
    	$id = Yii::$app->request->get('id');

    	$Promotion = Promotion::find()
		->where(['promotion_id'=>$id])
		->one()
		->delete();

		$model = new Promotion();
		$search = Yii::$app->request->queryParams;
        $dataProvider = $model->search($search);
		return $this->render('index', [
            'model' => $model,
            'dataProvider' => $dataProvider,
            'search' => $search
        ]);
    }

    public function save($model,$id=null)
    {

        $folder_upload = Yii::getAlias('@frontend').'/web/uploads';
        $year = date("Y");
        $month = date("m");

        $folder = $folder_upload."/".$year;
        if (!is_dir($folder)) {
            mkdir($folder);
        }
        $folder = $folder_upload."/".$year."/".$month;
        if (!is_dir($folder)) {
            mkdir($folder);
        }
        $path_folder = $year."/".$month;

        // Promotion
        $model->promotion_name_th = Yii::$app->request->post()['Promotion']['promotion_name_th'];
        $model->promotion_name_en = Yii::$app->request->post()['Promotion']['promotion_name_en'];
        $model->promotion_image_th = UploadedFile::getInstance($model, 'promotion_image_th');
        $model->promotion_image_en = UploadedFile::getInstance($model, 'promotion_image_en');

        if(!empty($model->promotion_image_th)){
        $promotion_image_th_file  = $model->promotion_image_th->baseName.'_'.time().'.'.$model->promotion_image_th->extension;
        $promotion_image_path  = $folder_upload."/".$path_folder."/".$promotion_image_th_file;
        $model->promotion_image_th->saveAs($promotion_image_path);
        $model->promotion_image_th = $promotion_image_th_file;
        $model->promotion_image_path = $path_folder;
        }else{
        $model->promotion_image_th = $model->getOldAttribute('promotion_image_th');
        $model->promotion_image_path = $model->getOldAttribute('promotion_image_path');
        }

        if(!empty($model->promotion_image_en)){
        $promotion_image_en_file  = $model->promotion_image_en->baseName.'_'.time().'.'.$model->promotion_image_en->extension;
        $promotion_image_path  = $folder_upload."/".$path_folder."/".$promotion_image_en_file;
        $model->promotion_image_en->saveAs($promotion_image_path);
        $model->promotion_image_en = $promotion_image_en_file;
        $model->promotion_image_path = $path_folder;
        }else{
        $model->promotion_image_en = $model->getOldAttribute('promotion_image_en');
        $model->promotion_image_path = $model->getOldAttribute('promotion_image_path');
        }

        $model->is_active = Yii::$app->request->post()['Promotion']['is_active'];
        $model->save();

        return true;
    }
}
