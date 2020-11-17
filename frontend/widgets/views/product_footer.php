<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<ul class="widget-list">
	<?php
	foreach ($product as $data) {
	?>
	<li><a href="<?=Url::base(true);?>/<?= Yii::t('app', 'menu_product');?>/<?= Yii::$app->slug->create($data['product_name_'.Yii::$app->language]); ?>-<?=$data['product_id']?>"><?= $data['product_name_'.Yii::$app->language]; ?></a></li>
	<?php } ?>
</ul>	