<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<ul>
	<?php
	foreach ($product as $data) {
		$active = '';
		if(Yii::$app->getRequest()->getQueryParam('slug_id') == $data['product_id']){
			$active = "active";
		}
		?>
	<li class="<?=$active?>"><a href="<?=Url::base(true);?>/<?= Yii::t('app', 'menu_product');?>/<?= Yii::$app->slug->create($data['product_name_'.Yii::$app->language]); ?>-<?=$data['product_id']?>"><img width="30" src="<?=Url::base(true);?>/uploads/<?= $data['product_icon_path'];?>/<?= $data['product_icon'];?>" style="display: inline-block;"> <?= $data['product_name_'.Yii::$app->language]; ?></a></li>
	<?php } ?>
</ul>	