<?php

namespace frontend\models;

use Yii;

class Register extends \common\models\Register
{
    public $FIRSTNAME;
    public $LASTNAME;
    
    public $Q1;
    public $Q2;
    public $Q3;
    public $Q4;
    public $Q5;

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['Q1', 'Q2', 'Q3', 'Q4', 'Q5'], 'safe'],
            [['FIRSTNAME', 'LASTNAME'], 'string', 'max' => 250],
        ]);
    }

    // public function attributeLabels()
    // {
    //     return [
    //         'pol_service_no' => 'หมายเลขใบรับรอง',
    //         'pol_holder_firstname' => 'ชื่อ',
    //         'pol_holder_lastname' => 'นามสกุล',
    //         'contract_partner_id' => 'ผู้ร่วมหุ้น',
    //         'pol_brand' => 'ยี่ห้อ',
    //         'pol_appliance_type' => 'ประเภทอุปกรณ์',
    //         'price_range' => 'price_range',
    //         'price_range_to' => 'price_range_to',
    //     ];
    // }

    // public function search($params)
    // {
    //     $query = Policy::find()->orderBy(['pol_id' => SORT_DESC]);
    //     $query->joinWith(['brand','applianceType']);

    //     $dataProvider = new ActiveDataProvider([
    //         'pagination' => [
    //             'defaultPageSize' => 20,
    //         ],
    //         'query' => $query,
    //     ]);

    //     $dataProvider->sort->attributes['brand'] = [
    //         'asc' => ['brand.brand_name' => SORT_ASC],
    //         'desc' => ['brand.brand_name' => SORT_DESC],
    //     ];
    //     $dataProvider->sort->attributes['applianceType'] = [
    //         'asc' => ['appliance_type.appliance_type_name' => SORT_ASC],
    //         'desc' => ['appliance_type.appliance_type_name' => SORT_DESC],
    //     ];


    //     if (!($this->load($params))) {
    //         return $dataProvider;
    //     }

    //     $query->andFilterWhere(['LIKE', 'pol_service_no', $this->pol_service_no]);
    //     $query->andFilterWhere(['like', 'pol_model', $this->pol_model]);
    //     $query->andFilterWhere(['like', 'pol_holder_firstname', $this->pol_holder_firstname]);
    //     $query->andFilterWhere(['like', 'pol_holder_lastname', $this->pol_holder_lastname]);
    //     $query->andFilterWhere(['=', 'pol_status', $this->pol_status]);
    //     $query->andFilterWhere(['=', 'contract_partner_id', $this->contract_partner_id]);
    //     $query->andFilterWhere(['=', 'pol_brand', $this->pol_brand]);
    //     $query->andFilterWhere(['=', 'pol_appliance_type', $this->pol_appliance_type]);
    //     return $dataProvider;
    // }
    public function beforeSave($insert) {

        // if ($this->isNewRecord) {
        //     $this->crdate = new \yii\db\Expression('NOW()');
        //     $this->cruser = $_COOKIE['c_mew_user_id'];

        //     $this->mddate = new \yii\db\Expression('NOW()');
        //     $this->mduser = $_COOKIE['c_mew_user_id'];
        // }

        return parent::beforeSave($insert);
    }
}
