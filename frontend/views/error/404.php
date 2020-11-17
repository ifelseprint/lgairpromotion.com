<?php
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\AppAsset;
AppAsset::register($this);
?>

<img src="https://portotheme.com/html/molla/assets/images/backgrounds/error-bg.jpg" width="100%">
<div class="container">
  <h1 class="error-title">Error 404</h1><!-- End .error-title -->
  <p>We are sorry, the page you've requested is not available.</p>
  <a href="<?=Url::base(true);?>" class="btn btn-outline-primary-2 btn-minwidth-lg">
     <span>BACK TO HOMEPAGE</span>
     <i class="icon-long-arrow-right"></i>
 </a>
</div><!-- End .container -->
