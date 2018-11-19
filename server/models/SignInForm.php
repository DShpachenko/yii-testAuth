<?php

namespace app\models;

use Yii;
use yii\base\Model;

class SignInForm extends Model
{
    public $phone;
    public $password;

    private $user = false;
    private $error;

    public function rules()
    {
        return [
            ['password', 'required', 'message' => 'Отсутствует значение!'],
            ['phone', 'required', 'message' => 'Отсутствует значение!'],            
            ['phone', 'match', 'pattern' => '%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i', 'message' => 'Не верный формат'],
        ];
    }

    public function login()
    {
        if(!$this->validate()) {
            $this->errors = $this->getErrors();

            return false;
        }

        $user = $this->getUser();

        if(!$user || !$user->validatePassword($this->password)) {
            $this->addError('password', 'Не верное имя или пароль!');

            return false;
        }

        return $user;
    }

    public function getUser()
    {
        if ($this->user === false) {
            $this->user = User::findByPhone($this->phone);
        }

        return $this->user;
    }

    public function getError()
    {
        return $this->errors;
    }
}
