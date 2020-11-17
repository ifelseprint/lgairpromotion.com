<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;

class Article extends \common\models\Article
{

    public $pageSize = 25;


    public function rules()
    {
        return array_merge(parent::rules(), [
            [['pageSize'], 'integer'],
        ]);
    }
    public function search($params)
    {

        $query = Article::find();
        $dataProvider = new ActiveDataProvider([
            'pagination' => [
                'pageSize' => $this->pageSize,
            ],
            'query' => $query,
            'sort'=> ['defaultOrder' => ['article_id' => SORT_DESC]]
        ]);

        if (!($this->load($params))) {
            return $dataProvider;
        }
        $query->andFilterWhere(['like', 'article_name_th', $this->article_name_th]);
        $query->andFilterWhere(['like', 'article_name_en', $this->article_name_en]);
        $query->andFilterWhere(['=', 'is_active', $this->is_active]);

        return $dataProvider;
    }
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        if ($insert) {
            //new record code here
            $this->created_user =  '1';
            $this->created_date =  date("Y-m-d H:i:s");
        } else {
            $this->modified_user =  '1';
            $this->modified_date = date("Y-m-d H:i:s");
        }
        return true;
    }
}
