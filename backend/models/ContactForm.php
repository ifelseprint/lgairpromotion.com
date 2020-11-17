<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;

class ContactForm extends \common\models\ContactForm
{

    public $pageSize = 25;
    public $searchFirstName;
    public $searchLastName;
    public $searchTel;
    public $searchEmail;
    public $searchFromDate;
    public $searchToDate;

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['searchFirstName', 'searchLastName', 'searchEmail'], 'string', 'max' => 100],
            [['searchTel'], 'string', 'max' => 20],
            [['searchFromDate','searchToDate'], 'safe'],
            [['pageSize'], 'integer'],
        ]);
    }
    public function search($params)
    {

        $query = ContactForm::find();
        $dataProvider = new ActiveDataProvider([
            'pagination' => [
                'pageSize' => $this->pageSize,
            ],
            'query' => $query,
            'sort'=> ['defaultOrder' => ['contact_form_id' => SORT_DESC]]
        ]);

        if (!($this->load($params))) {
            return $dataProvider;
        }
        if(!empty($this->searchFromDate)){
        $query->andFilterWhere(['>=', 'created_date',date('Y-m-d', strtotime(str_replace('/', '-', $this->searchFromDate)))]);
        }
        if(!empty($this->searchToDate)){
        $query->andFilterWhere(['<=', 'created_date',date('Y-m-d', strtotime(str_replace('/', '-', $this->searchToDate)))]);
        }
        $query->andFilterWhere(['like', 'contact_form_first_name', $this->searchFirstName]);
        $query->andFilterWhere(['like', 'contact_form_last_name', $this->searchLastName]);
        $query->andFilterWhere(['like', 'contact_form_tel', $this->searchTel]);
        $query->andFilterWhere(['like', 'contact_form_email', $this->searchEmail]);

        return $dataProvider;
    }

}
