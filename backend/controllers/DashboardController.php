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
                        'actions' => ['index','save','view','excel'],
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
    public function actionSave($id)
    {
        $post = Yii::$app->request->post();
        $Register = Register::find()
        ->where(['ID'=> base64_decode($id)])
        ->one();

        if(Yii::$app->request->isPost){

            $Register->load($post);
            $Register->QUESTION_2 = date('Y-m-d', strtotime(str_replace('/', '-', $post['Register']['QUESTION_2'])));
            $Register->save();
            // return $this->renderAjax('view', ['Register' => $Register]);
            return true;
        }
    }
    public function actionView($id)
    {
        $Register = Register::find()
        ->where(['ID'=> base64_decode($id)])
        ->one();

        $Register->QUESTION_2 = date('d/m/Y', strtotime(str_replace('-', '/', $Register->QUESTION_2)));

        return $this->renderAjax('view', ['Register' => $Register]);
    }

    public function actionExcel()
    {
        set_time_limit(0);
        $post = Yii::$app->request->post();

        if(Yii::$app->request->isPost){

            $searchModel = new Register();
            $dataExcel = $searchModel->search($post);

            if(empty($dataExcel->models)){
                return json_encode([
                    "status" => false,
                    "result" => 'No data generate report.'
                ]);
                exit;
            }
            return $this->render('excel-report', [
                "status" => true,
                "result" => 'Generate report successfully.',
                'search' => $post['Register'],
                'dataExcel' => $dataExcel->models,
            ]);
        }
    }

}
