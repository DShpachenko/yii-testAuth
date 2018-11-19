<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    public function init()
    {
        parent::init();
        \Yii::$app->user->enableSession = false;
    }

    public function rules()
    {
        return [
            ['token', 'unique', 'message' => 'Не уникальный токен, системная ошибка!'],
            ['phone', 'unique', 'message' => 'Не уникальный номер!']
        ];
    }

    public static function findToken($token)
    {
        return static::findOne(['token' => $token]);
    }

    public static function findByPhone($phone)
    {
        return static::findOne(['phone' => $phone]);
    }

    public function generateToken()
    {
        $this->token = Yii::$app->security->generateRandomString();
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
}
