<?php
use yii\helpers\Html;
use yii\helpers\Url;
// use frontend\assets\HomeAsset;
// HomeAsset::register($this);
?>
<div class='banner'>
  <img src="<?php echo Yii::$app->request->baseUrl; ?>/img/banner.png" width="100%">
</div>
  
<?= $this->render('_form', ['Register'=> $Register,'dataSerialNumber'=>$dataSerialNumber]); ?>

<hr>

<?= $this->render('_condition');?>

<?= $this->render('_modal');?>