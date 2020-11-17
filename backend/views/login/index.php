<?php
use yii\helpers\Html;
use yii\base\Widget;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>
<?php Pjax::begin(['id' => 'pjax-grid','timeout' => 0,'enablePushState' => false,]); ?>
<div id="loadingOverlay" class="loader-overlay" style="display: none;">
    <div class="loader-content loader-center">
        <div id="loading" class="loader"></div>
    </div>
</div>
<div class="wrapper">
  <div class="login-main-box">
    <div class="row" style="padding-bottom: 10px;">
      <div class="col-6 text-left"></div>
      <div class="col-6 text-right" style="padding-top:10px">
        <div class="appname-header">
          <i class="ti-settings"></i>  Management System <small>4.0</small>
        </div>
      </div>
    </div>
    <div class="card">                           
      <div class="row">
        <div class="col-6" style="background: url(<?=Url::base(true);?>/dist/img/login.jpg) no-repeat center center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;background-size: cover;background-position: top;"></div>
        <div class="col-6 p-3">
          <div class="card-body login-card-body">
            <?= $this->render('_form', ['model'=> $model]); ?>
          </div>
         <!-- /.login-card-body -->
        </div> 
      </div>
    </div>
  </div>
</div>
<?php
$script = <<<JS
  $("document").ready(function(){

    $("#pjax-grid").on("pjax:start", function() {
      $('#loadingOverlay').show();
    });
    $("#pjax-grid").on("pjax:end", function() {
      $('#loadingOverlay').hide();
    });
  });
JS;
$this->registerJs($script);
?>
<?php Pjax::end(); ?>