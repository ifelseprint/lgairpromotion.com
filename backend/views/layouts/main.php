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
<body class="hold-transition layout-top-nav pace-red">
<?php $this->beginBody() ?>

<div class="wrapper">
    <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="<?=Url::base(true);?>/dashboard" class="navbar-brand">
        <img src="<?=Url::base(true);?>/img/logo.png" alt="" style="width: 100px;">
      </a>
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item <?php echo (Yii::$app->controller->id=="dashboard" ? 'active' : '' )?>">
            <a href="<?=Url::base(true);?>/dashboard" class="nav-link"><i class="ti-home"></i> Dashboard</a>
          </li>   
        </ul>

      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        
        <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img src="<?=Url::base(true);?>/dist/img/guest.png" class="user-image img-circle" alt="User Image">
          <span class="d-none d-md-inline">Administrator</span>
          <i class="ti-angle-down" style="font-size:11px;"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu dropdown-menu-right dropdown-menu-sm">
          <!-- User image -->
          <li class="user-header bg-info">
            <img src="<?=Url::base(true);?>/dist/img/guest.png" class="img-circle elevation-2" alt="User Image">
            <p>
              Hi, Administrator
              <small><?=date("d/m/Y");?></small>
            </p>
          </li>
          <!-- Menu Body -->
          <!-- Menu Footer-->
          <li class="user-footer">
            <a href="<?=Url::base(true);?>/logout" class="btn btn-default btn-flat float-right btn-sm">Sign out</a>
          </li>
        </ul>
      </li>        
        
      </ul>
    </div>
    </nav>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <?= $content ?>
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <div class="container">
            <!-- To the right -->
            <div class="appname-footer float-right d-none d-sm-inline">
              <i class="fas fa-plug"></i> System<small> version 1.0</small> 
            </div>
            <!-- Default to the left -->
            Copyright &copy; <script>document.write(new Date().getFullYear());</script> <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://www.lgairpromotion.com" target="_blank">LG Air Promotion</a>. All rights reserved.
        </div>
    </footer>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
