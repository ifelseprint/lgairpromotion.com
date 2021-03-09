<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;

class Register extends \common\models\Register
{
    public $search_pageSize = 25;
    public $search_register_appId;
    public $search_register_name;
    public $search_register_email;
    public $search_register_tel;
    public $search_register_model;
    public $search_register_serial;
    public $search_date_range;
    public $search_date_service;

    public function attributeLabels()
    {
        return [
            'search_register_appId' => 'แคมเปญ',
            'search_register_name' => 'ชื่อ-นามสกุล',
            'search_register_email' => 'อีเมล',
            'search_register_tel' => 'เบอร์โทรศัพท์',
            'search_register_model' => 'รุ่นผลิตภัณฑ์',
            'search_register_serial' => 'หมายเลขซีเรียล',
            'search_pageSize' => 'แสดงต่อหน้า',
            'search_date_range' => 'วันที่ลงทะเบียน',
            'search_date_service' => 'วันที่รับบริการ'
        ];
    }
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['search_pageSize','search_register_appId'], 'integer'],
            [['search_date_range','search_date_service','search_register_name','search_register_email','search_register_tel','search_register_model','search_register_serial'], 'safe'],
        ]);
    }
    public function getShop()
    {
        return $this->hasOne(\common\models\Shop::className(), ['id' => 'QUESTION_3']);
    }
    public function getApplication()
    {
        return $this->hasOne(\common\models\Application::className(), ['ID' => 'APP_ID']);
    }
    public function search($params)
    {

        $query = Register::find();
        $query->joinWith(['application']);

        $dataProvider = new ActiveDataProvider([
            'pagination' => [
                'pageSize' => $this->search_pageSize,
                'route' => 'dashboard'
            ],
            'query' => $query,
            'sort'=> ['defaultOrder' => ['ID' => SORT_DESC]]
        ]);

        $dataProvider->sort->attributes['search_register_appId'] = [
            'asc' => ['application.NAME' => SORT_ASC],
            'desc' => ['application.NAME' => SORT_DESC],
        ];

        if (!($this->load($params))) {
            return $dataProvider;
        }

        if(!empty($this->search_date_range)){
            $date_range = explode("-",str_replace(' ', '', $this->search_date_range));
            if(isset($date_range[1])){
                $date_start = date('Y-m-d', strtotime(str_replace('/', '-', $date_range[0])));
                $date_end = date('Y-m-d', strtotime(str_replace('/', '-', $date_range[1])));
                $query->andFilterWhere(['between', 'DATE_FORMAT(register.CREATED_DATETIME,"%Y-%m-%d")', $date_start, $date_end]);
            }
        }

        if(!empty($this->search_date_service)){
            $date_service_range = explode("-",str_replace(' ', '', $this->search_date_service));
            if(isset($date_service_range[1])){
                $date_service_start = date('Y-m-d', strtotime(str_replace('/', '-', $date_service_range[0])));
                $date_service_end = date('Y-m-d', strtotime(str_replace('/', '-', $date_service_range[1])));
                $query->andFilterWhere(['between', 'DATE_FORMAT(register.QUESTION_2,"%Y-%m-%d")', $date_service_start, $date_service_end]);
            }
        }

        $query->andFilterWhere(['=', 'register.APP_ID', $this->search_register_appId]);
        $query->andFilterWhere(['like', 'register.FULLNAME', $this->search_register_name]);
        $query->andFilterWhere(['like', 'register.EMAIL', $this->search_register_email]);
        $query->andFilterWhere(['like', 'register.TEL', $this->search_register_tel]);
        $query->andFilterWhere(['like', 'register.SELECT_1', $this->search_register_model]);
        $query->andFilterWhere(['like', 'register.QUESTION_1', $this->search_register_serial]);
        return $dataProvider;
    }

}
