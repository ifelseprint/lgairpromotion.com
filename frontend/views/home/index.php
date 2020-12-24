<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use frontend\assets\AppAsset;
use frontend\assets\HomeAsset;
AppAsset::register($this);
?>
<div class='banner desktop' style="cursor: pointer;">
  <img src="<?php echo Yii::$app->request->baseUrl; ?>/img/homepage_banner.jpg" width="100%">
</div>
<div class='banner mobile' style="cursor: pointer;">
  <img src="<?php echo Yii::$app->request->baseUrl; ?>/img/homepage_banner_mobile.jpg" width="100%">
</div>
<?php echo $this->render('_list'); ?>

<?php
$script = <<<JS
  $("document").ready(function(){

    appLG.App.initializeInPjax();
    appLG.Home.initializeInPjax();
  });
JS;
$this->registerJs($script);
HomeAsset::register($this);
?>