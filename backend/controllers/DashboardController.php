<?php
namespace backend\controllers;

use Yii;
use backend\models\Register;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;

class DashboardController extends Controller
{
    /**
     * {@inheritdoc}
     */
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
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
        $searchModel = new Register();
        $dataProvider = $searchModel->search($search);


        $dataApplication = ArrayHelper::map(\common\models\Application::find()
        ->orderBy(['NAME' => SORT_ASC])
        ->all(), 'ID', 'NAME');

        if(Yii::$app->request->isPjax){

            if(!empty($search['Register'])){
                $dataProvider->pagination->pageSize = $search['Register']['search_pageSize'];
            }

            return $this->renderPartial('index', [
                'model' => $searchModel,
                'dataProvider' => $dataProvider,
                'dataApplication' => $dataApplication,
                'search' => $search
          ]);
        }else{
            return $this->render('index', [
                'model' => $searchModel,
                'dataProvider' => $dataProvider,
                'dataApplication' => $dataApplication,
                'search' => $search
           ]);

        }
    }
    public function actionView($id)
    {
        $Register = Register::find()
        ->where(['ID'=> base64_decode($id)])
        ->one();
        return $this->renderAjax('view', ['Register' => $Register]);
    }
    // public function actionCreate()
    // {
    //     echo "Create";
    // }
    // public function actionUpdate()
    // {
    //     echo "Update";
    // }
    // public function actionDelete()
    // {
    //     echo "Delete";
    // }
}
