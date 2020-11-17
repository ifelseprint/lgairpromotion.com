<?php
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\AppAsset;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>
<div class="page-wrapper">

    <?php echo $this->render('_header'); ?>

    <?= $content; ?>

    <?php echo $this->render('_footer'); ?>

</div><!-- End .page-wrapper -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
