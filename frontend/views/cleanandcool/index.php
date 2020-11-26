<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use frontend\assets\AppAsset;
use frontend\assets\CleanandcoolAsset;
AppAsset::register($this);
?>
<?php Pjax::begin(['id' => 'pjax-grid','timeout' => 0,'enablePushState' => false,]); ?>
<div id="loadingOverlay" class="loader-overlay" style="display: none;">
    <div class="loader-content loader-center">
        <div id="loading" class="loader"></div>
    </div>
</div>

<div class='banner' style="cursor: pointer;">
  <img src="<?php echo Yii::$app->request->baseUrl; ?>/img/cleanandcool/banner.png" width="100%">
</div>
  
<?= $this->render('_form', ['Register'=> $Register,'dataSerialNumber'=>$dataSerialNumber]); ?>

<hr>

<?= $this->render('_condition');?>

<?php
$script = <<<JS
  $("document").ready(function(){

    $("#pjax-grid").on("pjax:start", function() {
      $('#loadingOverlay').show();
    });
    $("#pjax-grid").on("pjax:end", function() {
      $('#loadingOverlay').hide();
    });

    appLG.App.initializeInPjax();
    appLG.Cleanandcool.initializeInPjax();
  });
JS;
$this->registerJs($script);
CleanandcoolAsset::register($this);
?>
<?php Pjax::end(); ?>

<?= $this->render('_modal');?>