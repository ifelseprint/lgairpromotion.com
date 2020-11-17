<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "serial_number".
 *
 * @property int $ID
 * @property int|null $APP_ID
 * @property string|null $MODEL
 * @property string|null $SERIAL_NUMBER
 * @property string|null $IS_STATUS
 */
class SerialNumber extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'serial_number';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['APP_ID'], 'integer'],
            [['IS_STATUS'], 'string'],
            [['MODEL', 'SERIAL_NUMBER'], 'string', 'max' => 100],
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
            'MODEL' => 'Model',
            'SERIAL_NUMBER' => 'Serial Number',
            'IS_STATUS' => 'Is Status',
        ];
    }
}
