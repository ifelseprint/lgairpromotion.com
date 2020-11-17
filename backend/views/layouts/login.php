<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Url;
use backend\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition layout-top-nav">
<?php $this->beginBody() ?>

    <?= $content ?>
    
    <!-- Main Footer -->
    <footer class="main-footer">
        <div class="container">
            <!-- To the right -->
            <div class="appname-footer float-right d-none d-sm-inline">
              <i class="fas fa-plug"></i> System<small> version 1.0</small> 
            </div>
            <!-- Default to the left -->
            Copyright &copy; <script>document.write(new Date().getFullYear());</script> <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://www.wehomemart.com" target="_blank">SC HOME MART</a>. All rights reserved.
        </div>
    </footer>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
