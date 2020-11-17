<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;

class Translate extends \common\models\Translate
{

    public $pageSize = 25;
    public $searchPage;

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['searchPage','pageSize'], 'integer'],
        ]);
    }
    public function getPages()
    {
        return $this->hasOne(Pages::className(), ['page_id' => 'page_id']);
    }
    public function search($params)
    { 
        $query = Translate::find();

        $dataProvider = new ActiveDataProvider([
            'pagination' => [
                'pageSize' => $this->pageSize,
            ],
            'query' => $query,
            'sort'=> ['defaultOrder' => ['page_id' => SORT_DESC]]
        ]);

        if (!($this->load($params))) {
            return $dataProvider;
        }

        $query->andFilterWhere(['=', 'page_id', $this->searchPage]);

        return $dataProvider;
    }
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        if ($insert) {
            //new record code here
            // $this->created_user =  '1';
            // $this->created_date =  date("Y-m-d H:i:s");
        } else {
            $this->modified_user =  '1';
            $this->modified_date = date("Y-m-d H:i:s");
        }
        return true;
    }
}
