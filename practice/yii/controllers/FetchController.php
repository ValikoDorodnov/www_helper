<?php

declare(strict_types=1);

namespace app\controllers;

use yii\web\Controller;

final class FetchController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}