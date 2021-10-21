<?php

declare(strict_types=1);

namespace app\modules\api\controllers;

use app\models\Post;
use yii\rest\ActiveController;

final class PostController extends ActiveController
{
    public $modelClass = Post::class;

    public function actionTest()
    {
        echo 'test';
    }
}
