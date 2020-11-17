<?php
namespace frontend\widgets;

class ProductMenu extends \yii\base\Widget {

    public $action;

    public function run() {

        $models = \common\models\Product::find()
        ->where(['is_active' => 1])
        ->orderBy(['product_id' => SORT_ASC])
        ->all();

        if($this->action=='link-nav'){
            $render = "product_menu_link_nav";
        }else if($this->action=='link-list-icon'){
            $render = "product_menu_link_list_icon";
        }
        return $this->render($render, [
            'product' => $models,
        ]);
    }
}
?>