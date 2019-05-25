<?php

namespace app\controllers;

use app\models\Signin;
use app\models\Signup;
use Yii;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionError()
    {
        return $this->render('error');
    }
}
