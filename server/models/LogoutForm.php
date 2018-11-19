<?php

namespace app\models;

use Yii;
use yii\base\Model;

class LogoutForm extends Model
{
    public $token;

    private $error;

    public function rules()
    {
        return [
            ['token', 'required', 'message' => 'Отсутствует значение!']
        ];
    }

    public function logOff()
    {
        if(!$this->validate()) {
            $this->errors = $this->getErrors();

            return false;
        }

        $user = User::findToken($this->token);

        if(!$user) {               
            $this->addError('token', 'Не найден указанный пользователь!');

            return false;
        }

        $user->generateToken();

        if(!$user->validate()) {
            $this->errors = $user->getErrors();

            return false;
        }

        return $user->save() ? true : false;
    }

    public function getError()
    {
        return $this->errors;
    }
}