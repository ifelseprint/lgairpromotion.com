<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "application".
 *
 * @property int $ID
 * @property string|null $NAME
 * @property string|null $LINK
 * @property string|null $DATE_RUN_APP
 * @property string|null $DATE_WINNER
 * @property string|null $DATE_CREATED
 */
class Application extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'application';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['LINK'], 'string'],
            [['DATE_RUN_APP', 'DATE_WINNER', 'DATE_CREATED'], 'safe'],
            [['NAME'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'NAME' => 'Name',
            'LINK' => 'Link',
            'DATE_RUN_APP' => 'Date Run App',
            'DATE_WINNER' => 'Date Winner',
            'DATE_CREATED' => 'Date Created',
        ];
    }
}
