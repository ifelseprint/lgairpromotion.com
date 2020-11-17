<?php
namespace frontend\widgets;

class ProductFooter extends \yii\base\Widget {

    public $offset;
    public $limit;

    public function run() {

        $models = \common\models\Product::find()
        ->where(['is_active' => 1])
        ->orderBy(['product_id' => SORT_ASC])
        ->offset($this->offset)
        ->limit($this->limit)
        ->all();

        return $this->render('product_footer', [
            'product' => $models,
        ]);
    }
}
?>