<?php
namespace backend\controllers;

use Yii;
use backend\models\LoginForm;
use backend\models\User;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * Site controller
 */
class AccessController extends Controller
{
    public function behaviors()
    {
        return [

            // 'access'=>[
            //     'class'=> AccessControl::className(),
            //     'only' => ['profile','after-profile','login','logout'],
            //     'rules'=>[
            //         [
            //             'actions'=>['profile','after-profile','logout'],
            //             'allow'=> true,
            //             'roles'=>['@']
            //         ],
            //         [
            //             'actions'=>['login'],
            //             'allow'=> true,
            //             'roles'=>['?']
            //         ]
            //     ],
            // ]
        ];
    }
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    public function actionProfile()
    {

        $User = User::find()->where(['user_id'=> Yii::$app->session['user']->user_id])->one();

        if(Yii::$app->request->isPost){

            $post = Yii::$app->request->post();
            $user_name = $post['User']['user_name'];
            $user_password = ($post['User']['user_password']==$User->user_password) ? $User->user_password : SHA1(SHA1(MD5($post['User']['user_password'])));

            $Partner = \common\models\Partner::find()->where(['partner_id'=> $User->user_partner])->one();

            if ($User->load($post)){

                $User->user_login_name = $user_name.$Partner->partner_login_code;
                $User->user_password = $user_password;
                $User->mddate = new \yii\db\Expression('NOW()');

                if ($User->save()) {
                    return json_encode([
                        "status" => true,
                        "result"=> $User->user_id
                    ]);
                }else{
                    return json_encode([
                        "status" => false,
                        "result" => $User->getErrors()
                    ]);
                }
            }
        }

        return $this->render('profile', [
            'User' => $User
        ]);
    }

    public function actionAfterProfile($id)
    {
        $User = User::find()
        ->where(['user_id'=> $id])
        ->one();
        return $this->renderAjax('action_update', ['User' => $User]);
    }


    public function actionLogin()
    {

        $this->layout = 'login';

        // $session = Yii::$app->session;
        // $session->destroy();
        // Yii::$app->user->logout();

        if (!Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->urlManager->createUrl(['dashboard']));
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {

            if($model->login()){

                return $this->redirect(Yii::$app->urlManager->createUrl(['dashboard']));

            }else {
                return json_encode([
                    "status" => false,
                    "result" => 'ชื่อผู้เข้าใช้งาน หรือ รหัสผ่านผู้เข้าใช้งาน ไม่ถูกต้อง.'
                ]);
            }

        }

        $model->password = '';

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        $this->layout = false;
        $session = Yii::$app->session;
        $session->destroy();
        Yii::$app->user->logout();

        return $this->redirect(Yii::$app->urlManager->createUrl(['login/index']));
    }
}
