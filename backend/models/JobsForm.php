<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;

class JobsForm extends \common\models\JobsForm
{

    public $pageSize = 25;
    public $searchPosition;
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
            [['searchPosition','pageSize'], 'integer'],
        ]);
    }
    public function search($params)
    {

        $query = JobsForm::find();
        $query->joinWith("jobs");
        $dataProvider = new ActiveDataProvider([
            'pagination' => [
                'pageSize' => $this->pageSize,
            ],
            'query' => $query,
            'sort'=> [
                'defaultOrder' => ['created_date' => SORT_DESC]
            ]
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
        $query->andFilterWhere(['=', 'jobs_form_position', $this->searchPosition]);
        $query->andFilterWhere(['like', 'jobs_form_first_name', $this->searchFirstName]);
        $query->andFilterWhere(['like', 'jobs_form_last_name', $this->searchLastName]);
        $query->andFilterWhere(['like', 'jobs_form_tel', $this->searchTel]);
        $query->andFilterWhere(['like', 'jobs_form_email', $this->searchEmail]);

        return $dataProvider;
    }
    public function getJobs()
    {
        return $this->hasOne(Jobs::className(), ['jobs_id' => 'jobs_form_position']);
    }
}
