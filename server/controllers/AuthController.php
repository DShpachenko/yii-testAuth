<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\SignInForm;
use app\models\SignUpForm;
use app\models\LogoutForm;

class AuthController extends Controller
{
    public function actionSignin()
    {
        $signIn = new SignInForm();

        if($signIn->load(Yii::$app->request->get(), '')) {
            if($signIn->login()) {
                return $this->asJson([
                    'user' => User::findByPhone($signIn->phone)
                ]);
            }
        }

        return $this->asJson([
            'errors' => $signIn->getError()
        ]);
    }

    public function actionLogout()
    {
        $logOut = new LogoutForm();

        if($logOut->load(Yii::$app->request->get(), '')) {
            if($logOut->logOff()) {
                return $this->asJson([
                    'status' => true
                ]);
            }
        }

        return $this->asJson([
            'errors' => $logOut->getError()
        ]);
    }

    public function actionSignup()
    {
        $signUp = new SignUpForm();

        if($signUp->load(Yii::$app->request->get(), '')) {
            if($signUp->registration()) {
                return $this->asJson([
                    'user' => User::findByPhone($signUp->phone)
                ]);
            }
        }

        return $this->asJson([
            'errors' => $signUp->getError()
        ]);
    }    
}