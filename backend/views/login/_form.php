<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>
<p class="login-box-msg">Sign in to start your session</p>
<?php $form = ActiveForm::begin([
  'method' => 'post',
  'id' => 'form-login',
  'action' => ['login/index'],
  'options' => ['enctype' => 'multipart/form-data','data-pjax' => true],
  'fieldConfig' => [
    'template' => "{input} <div style='position: fixed;margin-top: 37px;color: #f00;'>{error}</div>",
    'inputOptions' => ['class' => 'form-control'],
  ],
]);
?>
<label class="col-form-label-sm">Username :</label>
<div class="input-group mb-3">
    <?= $form->field($model, 'login_username', ['options' => ['tag' => false]]); ?>
    <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-user"></span>
        </div>
    </div>
</div>
<label class="col-form-label-sm">Password :</label>
<div class="input-group mb-3">
    <?= $form->field($model, 'login_password', ['options' => ['tag' => false]])->passwordInput(); ?>
    <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-lock"></span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-8"></div>
    <!-- /.col -->
    <div class="col-4">
        <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
    </div>
    <!-- /.col -->
</div>

<?php ActiveForm::end(); ?>


