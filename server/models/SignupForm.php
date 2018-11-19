<?php

namespace app\models;

use Yii;
use yii\base\Model;

class SignUpForm extends Model
{
    public $phone;
    public $password;
    public $surname;
    public $name;
    public $patronymic;
    public $sex;
    public $birthday;

    private $errors;

    public function rules()
    {
        return [
            ['phone', 'required', 'message' => 'Отсутствует значение!'],
            
            ['phone', 'match', 'pattern' => '%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i', 'message' => 'Не верный формат'],
            ['password', 'required', 'message' => 'Отсутствует значение!'],
            ['surname', 'required', 'message' => 'Отсутствует значение!'],
            ['name', 'required', 'message' => 'Отсутствует значение!'],
            ['patronymic', 'string', 'message' => 'Не верный формат!'],
            ['sex', 'integer', 'message' => 'Не верный формат!'],
            [['birthday'], 'date', 'format' => 'yyyy-mm-dd', 'message' => 'Не верный формат!']
        ];
    }

    public function registration()
    {
        if(!$this->validate()) {
            $this->errors = $this->getErrors();

            return false;
        }

        $user = new User();

        $user->phone      = $this->phone;
        $user->surname    = $this->surname;
        $user->name       = $this->name;
        $user->patronymic = $this->patronymic;
        $user->sex        = $this->sex;
        $user->birthday   = $this->birthday;

        $user->setPassword($this->password);
        $user->generateToken();

        if(!$user->validate()) {
            $this->errors = $user->getErrors();

            return false;
        }

        return $user->save() ? $user : false;
    }

    public function getError()
    {
        return $this->errors;
    }
}
