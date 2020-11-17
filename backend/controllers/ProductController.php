<?php

namespace backend\controllers;
use Yii;
use yii\web\Controller;
use yii\web\Request;
use backend\models\Product;
use common\models\ProductDetail;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
class ProductController extends \yii\web\Controller
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
    	$model = new Product();
        $dataProvider = $model->search($search);
        if(Yii::$app->request->isPjax){

        	if(!empty($search['Product']['pageSize'])){
        		$dataProvider->pagination->pageSize = $search['Product']['pageSize'];
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
    	$Product = new Product();
    	$ProductDetail = new ProductDetail();
    	if (Yii::$app->request->isAjax) {
            if(Yii::$app->request->isPost){
				$save = $this->save($Product,$ProductDetail,null);
            }
        }
        return $this->renderAjax('create', [
			'Product' => $Product,
			'ProductDetail' => $ProductDetail,
		]);
    }

    public function actionUpdate()
    {
    	$id = Yii::$app->request->get('id');
    	$Product = Product::findOne(['product_id' => $id]);
    	$ProductDetail = ProductDetail::findOne(['product_id' => $id]);
    	if (Yii::$app->request->isAjax) {
            if(Yii::$app->request->isPost){
            	$save = $this->save($Product,$ProductDetail,$id);
            }
        }
    	return $this->renderAjax('update', [
			'Product' => $Product,
			'ProductDetail' => $ProductDetail,
		]);
    }

    public function actionDelete()
    {
    	$id = Yii::$app->request->get('id');

    	$ProductDetail = ProductDetail::find()
		->where(['product_id'=>$id])
		->one()
		->delete();

    	$Product = Product::find()
		->where(['product_id'=>$id])
		->one()
		->delete();

		$model = new Product();
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

    	// product
    	$model->product_name_th = Yii::$app->request->post()['Product']['product_name_th'];
    	$model->product_name_en = Yii::$app->request->post()['Product']['product_name_en'];

        $model->meta_tag_title_th = Yii::$app->request->post()['Product']['meta_tag_title_th'];
        $model->meta_tag_title_en = Yii::$app->request->post()['Product']['meta_tag_title_en'];
        $model->meta_tag_description_th = Yii::$app->request->post()['Product']['meta_tag_description_th'];
        $model->meta_tag_description_en = Yii::$app->request->post()['Product']['meta_tag_description_en'];
        $model->meta_tag_keywords_th = Yii::$app->request->post()['Product']['meta_tag_keywords_th'];
        $model->meta_tag_keywords_en = Yii::$app->request->post()['Product']['meta_tag_keywords_en'];

    	$model->product_icon = UploadedFile::getInstance($model, 'product_icon');
    	if(!empty($model->product_icon)){
		$product_icon_file  = $model->product_icon->baseName.'_'.time().'.'.$model->product_icon->extension;
		$product_icon_path  = $folder_upload."/".$path_folder."/".$product_icon_file;
		$model->product_icon->saveAs($product_icon_path);
		$model->product_icon = $product_icon_file;
		$model->product_icon_path = $path_folder;
		}else{
		$model->product_icon = $model->getOldAttribute('product_icon');
		$model->product_icon_path = $model->getOldAttribute('product_icon_path');
		}

        $model->product_image = UploadedFile::getInstance($model, 'product_image');
        if(!empty($model->product_image)){
        $product_image_file  = $model->product_image->baseName.'_'.time().'.'.$model->product_image->extension;
        $product_image_path  = $folder_upload."/".$path_folder."/".$product_image_file;
        $model->product_image->saveAs($product_image_path);
        $model->product_image = $product_image_file;
        $model->product_image_path = $path_folder;
        }else{
        $model->product_image = $model->getOldAttribute('product_image');
        $model->product_image_path = $model->getOldAttribute('product_image_path');
        }

        $model->product_image_hover = UploadedFile::getInstance($model, 'product_image_hover');
        if(!empty($model->product_image_hover)){
        $product_image_hover_file  = $model->product_image_hover->baseName.'_'.time().'.'.$model->product_image_hover->extension;
        $product_image_hover_path  = $folder_upload."/".$path_folder."/".$product_image_hover_file;
        $model->product_image_hover->saveAs($product_image_hover_path);
        $model->product_image_hover = $product_image_hover_file;
        $model->product_image_hover_path = $path_folder;
        }else{
        $model->product_image_hover = $model->getOldAttribute('product_image_hover');
        $model->product_image_hover_path = $model->getOldAttribute('product_image_hover_path');
        }

		$model->is_active = Yii::$app->request->post()['Product']['is_active'];
		$model->save();

		// product detail
		$model2->product_detail_content_th = Yii::$app->request->post()['ProductDetail']['product_detail_content_th'];
    	$model2->product_detail_content_en = Yii::$app->request->post()['ProductDetail']['product_detail_content_en'];
    	$model2->product_detail_image = UploadedFile::getInstance($model2, 'product_detail_image');

    	if(!empty($model2->product_detail_image)){
		$product_detail_image_file  = $model2->product_detail_image->baseName.'_'.time().'.'.$model2->product_detail_image->extension;
		$product_detail_image_path  = $folder_upload."/".$path_folder."/".$product_detail_image_file;
		$model2->product_detail_image->saveAs($product_detail_image_path);
		$model2->product_detail_image = $product_detail_image_file;
		$model2->product_detail_image_path = $path_folder;
		}else{
		$model2->product_detail_image = $model2->getOldAttribute('product_detail_image');
		$model2->product_detail_image_path = $model2->getOldAttribute('product_detail_image_path');
		}
		$model2->save();
    }
}
