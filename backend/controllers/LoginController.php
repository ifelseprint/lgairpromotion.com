<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\Users;
use yii\helpers\Url;

/**
 * Site controller
 */
class LoginController extends Controller
{
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
        // $user = new Users();
        // $user->login_username = 'admin';
        // $user->login_password =  $user->setPassword('1234');
        // $user->is_active = 1;
        // $user->setPassword('1234');
        // $user->generateAuthKey();
        // $user->generateEmailVerificationToken();
        // $user->save();
        // exit;
        $this->layout = 'login';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $LoginForm = new LoginForm();
        if ($LoginForm->load(Yii::$app->request->post()) && $LoginForm->login()) {
            Yii::$app->response->redirect(['dashboard/index']);
            // return $this->goBack();
        } else {
            $LoginForm->login_password = '';

            return $this->render('index', [
                'model' => $LoginForm,
            ]);
        }
    }
}
