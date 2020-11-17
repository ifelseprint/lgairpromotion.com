<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "register".
 *
 * @property int $ID
 * @property int|null $APP_ID
 * @property string|null $FB_ID
 * @property string|null $FB_PICTURE
 * @property string|null $FULLNAME
 * @property string|null $TEL
 * @property string|null $EMAIL
 * @property string|null $ADDRESS
 * @property string|null $ZIPCODE
 * @property string|null $PROVINCE
 * @property string|null $AMPHUR
 * @property string|null $DISTRICT
 * @property string|null $SELECT_1
 * @property string|null $SELECT_2
 * @property string|null $SELECT_3
 * @property string|null $SELECT_4
 * @property string|null $SELECT_5
 * @property string|null $QUESTION_1
 * @property string|null $QUESTION_2
 * @property string|null $QUESTION_3
 * @property string|null $QUESTION_4
 * @property string|null $QUESTION_5
 * @property string|null $FILE_1
 * @property string|null $FILE_2
 * @property string|null $FILE_3
 * @property string|null $FILE_4
 * @property string|null $FILE_5
 * @property string|null $PATH_FILE_1
 * @property string|null $PATH_FILE_2
 * @property string|null $PATH_FILE_3
 * @property string|null $PATH_FILE_4
 * @property string|null $PATH_FILE_5
 * @property string|null $IP
 * @property string|null $IS_SHARE
 * @property string|null $IS_STATUS
 * @property string|null $IS_APPROVED
 * @property string|null $CREATED_DATETIME
 * @property string|null $CREATED_AT
 * @property string|null $UPDATED_DATETIME
 * @property string|null $UPDATED_AT
 * @property string|null $UTM_SOURCE
 * @property string|null $UTM_MEDIUM
 * @property string|null $UTM_CAMPAIGN
 */
class Register extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'register';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['APP_ID'], 'integer'],
            [['QUESTION_1', 'QUESTION_2', 'QUESTION_3', 'QUESTION_4', 'QUESTION_5', 'IS_SHARE', 'IS_STATUS', 'IS_APPROVED', 'UTM_SOURCE', 'UTM_MEDIUM', 'UTM_CAMPAIGN'], 'string'],
            [['CREATED_DATETIME', 'UPDATED_DATETIME'], 'safe'],
            [['FB_ID'], 'string', 'max' => 100],
            [['FB_PICTURE', 'FULLNAME', 'TEL', 'EMAIL', 'ADDRESS', 'ZIPCODE', 'PROVINCE', 'AMPHUR', 'DISTRICT', 'SELECT_1', 'SELECT_2', 'SELECT_3', 'SELECT_4', 'SELECT_5', 'FILE_1', 'FILE_2', 'FILE_3', 'FILE_4', 'FILE_5', 'IP', 'CREATED_AT', 'UPDATED_AT'], 'string', 'max' => 255],
            [['PATH_FILE_1', 'PATH_FILE_2', 'PATH_FILE_3', 'PATH_FILE_4', 'PATH_FILE_5'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'APP_ID' => 'App ID',
            'FB_ID' => 'Fb ID',
            'FB_PICTURE' => 'Fb Picture',
            'FULLNAME' => 'Fullname',
            'TEL' => 'Tel',
            'EMAIL' => 'Email',
            'ADDRESS' => 'Address',
            'ZIPCODE' => 'Zipcode',
            'PROVINCE' => 'Province',
            'AMPHUR' => 'Amphur',
            'DISTRICT' => 'District',
            'SELECT_1' => 'Select 1',
            'SELECT_2' => 'Select 2',
            'SELECT_3' => 'Select 3',
            'SELECT_4' => 'Select 4',
            'SELECT_5' => 'Select 5',
            'QUESTION_1' => 'Question 1',
            'QUESTION_2' => 'Question 2',
            'QUESTION_3' => 'Question 3',
            'QUESTION_4' => 'Question 4',
            'QUESTION_5' => 'Question 5',
            'FILE_1' => 'File 1',
            'FILE_2' => 'File 2',
            'FILE_3' => 'File 3',
            'FILE_4' => 'File 4',
            'FILE_5' => 'File 5',
            'PATH_FILE_1' => 'Path File 1',
            'PATH_FILE_2' => 'Path File 2',
            'PATH_FILE_3' => 'Path File 3',
            'PATH_FILE_4' => 'Path File 4',
            'PATH_FILE_5' => 'Path File 5',
            'IP' => 'Ip',
            'IS_SHARE' => 'Is Share',
            'IS_STATUS' => 'Is Status',
            'IS_APPROVED' => 'Is Approved',
            'CREATED_DATETIME' => 'Created Datetime',
            'CREATED_AT' => 'Created At',
            'UPDATED_DATETIME' => 'Updated Datetime',
            'UPDATED_AT' => 'Updated At',
            'UTM_SOURCE' => 'Utm Source',
            'UTM_MEDIUM' => 'Utm Medium',
            'UTM_CAMPAIGN' => 'Utm Campaign',
        ];
    }
}
