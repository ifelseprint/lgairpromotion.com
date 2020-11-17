<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $login_id
 * @property string|null $login_username
 * @property string|null $login_password
 * @property string|null $password_reset_token
 * @property string|null $auth_key
 * @property string|null $verification_token
 * @property int|null $is_active
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_active'], 'integer'],
            [['login_username', 'login_password'], 'string', 'max' => 100],
            [['password_reset_token', 'auth_key', 'verification_token'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'login_id' => 'Login ID',
            'login_username' => 'Login Username',
            'login_password' => 'Login Password',
            'password_reset_token' => 'Password Reset Token',
            'auth_key' => 'Auth Key',
            'verification_token' => 'Verification Token',
            'is_active' => 'Is Active',
        ];
    }
}
