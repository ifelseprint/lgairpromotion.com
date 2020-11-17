<?php

namespace backend\controllers;
use Yii;
use yii\web\Controller;
use yii\web\Request;
use backend\models\Banner;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
class BannerController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index','update','delete'],
                        'allow' => true,
                        'roles' => ['@'], // @ = login, ? = no login
                    ],
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        $pages = ArrayHelper::map(\common\models\Pages::find()
        ->andWhere(['<>', 'page_id', 2])
        ->andWhere(['<>', 'page_id', 0])
        ->orderBy(['page_id' => SORT_ASC])
        ->all(), 'page_id', 'page_name_th');

        $search = Yii::$app->request->queryParams;
    	$model = new Banner();
        $dataProvider = $model->search($search);
        if(Yii::$app->request->isPjax){

        	if(!empty($search['Banner']['pageSize'])){
        		$dataProvider->pagination->pageSize = $search['Banner']['pageSize'];
        	}
        	return $this->renderPartial('index', [
        		'model' => $model,
            	'dataProvider' => $dataProvider,
            	'search' => $search,
                'pages' => $pages
        	]);
        }else{
        	return $this->render('index', [
        		'model' => $model,
            	'dataProvider' => $dataProvider,
            	'search' => $search,
                'pages' => $pages
        	]);

        }
    }
    public function actionUpdate()
    {
    	$id = Yii::$app->request->get('id');
        $Banner = Banner::findOne(['banner_id' => $id]);
    	if (Yii::$app->request->isAjax) {
            if(Yii::$app->request->isPost){
            	$save = $this->save($Banner);
            }
        }
    	return $this->renderAjax('update', [
            'Banner' => $Banner,
		]);
    }

    public function actionDelete()
    {
        $id = Yii::$app->request->queryParams['id'];
        $mapping_id = Yii::$app->request->post()['mapping_id'];
        $image_id = Yii::$app->request->post()['image_id'];
        $field_image = 'banner_image_'.$image_id;
        $field_path = 'banner_image_'.$image_id.'_path';
        $Banner = Banner::findOne(['banner_page_id' => $id,'banner_mapping_id' => $mapping_id]);
        $Banner->$field_image = null;
        $Banner->$field_path = null;
        $Banner->save();
    }

    public function save($banner)
    {
        
        $banner->banner_image_1 = UploadedFile::getInstance($banner, 'banner_image_1');
        $banner->banner_image_2 = UploadedFile::getInstance($banner, 'banner_image_2');
        $banner->banner_image_3 = UploadedFile::getInstance($banner, 'banner_image_3');
        $banner->banner_image_4 = UploadedFile::getInstance($banner, 'banner_image_4');
        $banner_image_1 = $banner->upload('banner_image_1');
        $banner_image_2 = $banner->upload('banner_image_2');
        $banner_image_3 = $banner->upload('banner_image_3');
        $banner_image_4 = $banner->upload('banner_image_4');
     
        if(!empty($banner_image_1)){
            $banner->banner_image_1 = $banner_image_1['fileName'];
            $banner->banner_image_1_path = $banner_image_1['filePath'];
        }else{
            $banner->banner_image_1 = $banner->getOldAttribute('banner_image_1');
            $banner->banner_image_1_path = $banner->getOldAttribute('banner_image_1_path');
        }
        if(!empty($banner_image_2)){
            $banner->banner_image_2 = $banner_image_2['fileName'];
            $banner->banner_image_2_path = $banner_image_2['filePath'];
        }else{
            $banner->banner_image_2 = $banner->getOldAttribute('banner_image_2');
            $banner->banner_image_2_path = $banner->getOldAttribute('banner_image_2_path');
        }
        if(!empty($banner_image_3)){
            $banner->banner_image_3 = $banner_image_3['fileName'];
            $banner->banner_image_3_path = $banner_image_3['filePath'];
        }else{
            $banner->banner_image_3 = $banner->getOldAttribute('banner_image_3');
            $banner->banner_image_3_path = $banner->getOldAttribute('banner_image_3_path');
        }
        if(!empty($banner_image_4)){
            $banner->banner_image_4 = $banner_image_4['fileName'];
            $banner->banner_image_4_path = $banner_image_4['filePath'];
        }else{
            $banner->banner_image_4 = $banner->getOldAttribute('banner_image_4');
            $banner->banner_image_4_path = $banner->getOldAttribute('banner_image_4_path');
        }
        $banner->save();
        return true;
    }
}
