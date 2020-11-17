<?php

namespace backend\controllers;
use Yii;
use yii\web\Controller;
use yii\web\Request;
use backend\models\Article;
use common\models\ArticleDetail;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
class ArticleController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index','create', 'update', 'delete'],
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
    	$model = new Article();
        $dataProvider = $model->search($search);
        if(Yii::$app->request->isPjax){

        	if(!empty($search['Article']['pageSize'])){
        		$dataProvider->pagination->pageSize = $search['Article']['pageSize'];
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
    	$Article = new Article();
    	$ArticleDetail = new ArticleDetail();
    	if (Yii::$app->request->isAjax) {
            if(Yii::$app->request->isPost){
                $save = $this->save($Article,$ArticleDetail,null);
            }
        }
        return $this->renderAjax('create', [
			'Article' => $Article,
			'ArticleDetail' => $ArticleDetail,
		]);
    }

    public function actionUpdate()
    {
    	$id = Yii::$app->request->get('id');
    	$Article = Article::findOne(['article_id' => $id]);
    	$ArticleDetail = ArticleDetail::findOne(['article_id' => $id]);
    	if (Yii::$app->request->isAjax) {
            if(Yii::$app->request->isPost){
                $save = $this->save($Article,$ArticleDetail,$id);
            }
        }
    	return $this->renderAjax('update', [
			'Article' => $Article,
			'ArticleDetail' => $ArticleDetail,
		]);
    }

    public function actionDelete()
    {
    	$id = Yii::$app->request->get('id');
    	$ArticleDetail = ArticleDetail::find()
		->where(['article_id'=>$id])
		->one()
		->delete();

    	$Article = Article::find()
		->where(['article_id'=>$id])
		->one()
		->delete();

		$model = new Article();
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

        // Article
        $model->article_name_th = Yii::$app->request->post()['Article']['article_name_th'];
        $model->article_name_en = Yii::$app->request->post()['Article']['article_name_en'];
        $model->article_content_th = Yii::$app->request->post()['Article']['article_content_th'];
        $model->article_content_en = Yii::$app->request->post()['Article']['article_content_en'];

        $model->meta_tag_title_th = Yii::$app->request->post()['Article']['meta_tag_title_th'];
        $model->meta_tag_title_en = Yii::$app->request->post()['Article']['meta_tag_title_en'];
        $model->meta_tag_description_th = Yii::$app->request->post()['Article']['meta_tag_description_th'];
        $model->meta_tag_description_en = Yii::$app->request->post()['Article']['meta_tag_description_en'];
        $model->meta_tag_keywords_th = Yii::$app->request->post()['Article']['meta_tag_keywords_th'];
        $model->meta_tag_keywords_en = Yii::$app->request->post()['Article']['meta_tag_keywords_en'];

        $model->article_image = UploadedFile::getInstance($model, 'article_image');

        if(!empty($model->article_image)){
        $article_image_file  = $model->article_image->baseName.'_'.time().'.'.$model->article_image->extension;
        $article_image_path  = $folder_upload."/".$path_folder."/".$article_image_file;
        $model->article_image->saveAs($article_image_path);
        $model->article_image = $article_image_file;
        $model->article_image_path = $path_folder;
        }else{
        $model->article_image = $model->getOldAttribute('article_image');
        $model->article_image_path = $model->getOldAttribute('article_image_path');
        }
        $model->is_active = Yii::$app->request->post()['Article']['is_active'];
        $model->save();

        // Article detail
        $model2->article_detail_content_th = Yii::$app->request->post()['ArticleDetail']['article_detail_content_th'];
        $model2->article_detail_content_en = Yii::$app->request->post()['ArticleDetail']['article_detail_content_en'];
        $model2->save();

        return true;
    }
}
