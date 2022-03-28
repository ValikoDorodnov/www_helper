<?php

declare(strict_types=1);

namespace app\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;

final class XFilesController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['secure'],
                        'roles' => ['admin'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSecure()
    {
        return $this->render('secure');
    }
}
