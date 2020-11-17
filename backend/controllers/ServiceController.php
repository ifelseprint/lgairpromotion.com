<?php

namespace backend\controllers;
use Yii;
use yii\web\Controller;
use yii\web\Request;
use backend\models\Service;
use common\models\ServiceDetail;
use backend\models\Banner;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
class ServiceController extends \yii\web\Controller
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
    	$model = new Service();
        $dataProvider = $model->search($search);
        if(Yii::$app->request->isPjax){

        	if(!empty($search['Service']['pageSize'])){
        		$dataProvider->pagination->pageSize = $search['Service']['pageSize'];
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
    	$Service = new Service();
    	$ServiceDetail = new ServiceDetail();
        $Banner = new Banner();

    	if (Yii::$app->request->isAjax) {
            if(Yii::$app->request->isPost){
            	$save = $this->save($Service,$ServiceDetail,$Banner,null);
            }
        }
        return $this->renderAjax('create', [
			'Service' => $Service,
			'ServiceDetail' => $ServiceDetail,
            'Banner' => $Banner,
		]);
    }

    public function actionUpdate()
    {
    	$id = Yii::$app->request->get('id');
    	$Service = Service::findOne(['service_id' => $id]);
    	$ServiceDetail = ServiceDetail::findOne(['service_id' => $id]);
        $Banner = Banner::findOne(['banner_page_id' => 2,'banner_mapping_id' => $id]);
        // $Banner->banner_image = array();
        // 
        // $Banner = new Banner();
    	if (Yii::$app->request->isAjax) {
            if(Yii::$app->request->isPost){
            	$save = $this->save($Service,$ServiceDetail,$Banner,$id);
            }
        }
    	return $this->renderAjax('update', [
			'Service' => $Service,
            'ServiceDetail' => $ServiceDetail,
            'Banner' => $Banner,
		]);
    }

    public function actionDelete()
    {
    	$id = Yii::$app->request->get('id');
    	$ServiceDetail = ServiceDetail::find()
		->where(['service_id'=>$id])
		->one()
		->delete();

    	$Service = Service::find()
		->where(['service_id'=>$id])
		->one()
		->delete();

		$model = new Service();
		$search = Yii::$app->request->queryParams;
        $dataProvider = $model->search($search);
		return $this->render('index', [
            'model' => $model,
            'dataProvider' => $dataProvider,
            'search' => $search
        ]);
    }


    public function save($model,$model2=null,$banner=null,$id=null)
    {

        // Service
        $model->service_name_th = Yii::$app->request->post()['Service']['service_name_th'];
        $model->service_name_en = Yii::$app->request->post()['Service']['service_name_en'];
        $model->service_content_th = Yii::$app->request->post()['Service']['service_content_th'];
        $model->service_content_en = Yii::$app->request->post()['Service']['service_content_en'];

        $model->meta_tag_title_th = Yii::$app->request->post()['Service']['meta_tag_title_th'];
        $model->meta_tag_title_en = Yii::$app->request->post()['Service']['meta_tag_title_en'];
        $model->meta_tag_description_th = Yii::$app->request->post()['Service']['meta_tag_description_th'];
        $model->meta_tag_description_en = Yii::$app->request->post()['Service']['meta_tag_description_en'];
        $model->meta_tag_keywords_th = Yii::$app->request->post()['Service']['meta_tag_keywords_th'];
        $model->meta_tag_keywords_en = Yii::$app->request->post()['Service']['meta_tag_keywords_en'];
        
        $model->service_image = UploadedFile::getInstance($model, 'service_image');
        $service_image = $model->upload();
        if(!empty($service_image)){
            $model->service_image = $service_image['fileName'];
            $model->service_image_path = $service_image['filePath'];
        }else{
            $model->service_image = $model->getOldAttribute('service_image');
            $model->service_image_path = $model->getOldAttribute('service_image_path');
        }
        $model->is_active = Yii::$app->request->post()['Service']['is_active'];
        $model->save();

        // Service detail
        $model2->service_id = $model->service_id;
        $model2->service_detail_content_th = Yii::$app->request->post()['ServiceDetail']['service_detail_content_th'];
        $model2->service_detail_content_en = Yii::$app->request->post()['ServiceDetail']['service_detail_content_en'];
        $model2->save();

        $banner->banner_page_id = 2;
        $banner->banner_mapping_id = $model->service_id;
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
