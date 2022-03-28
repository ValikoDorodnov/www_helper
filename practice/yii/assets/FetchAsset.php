<?php

declare(strict_types=1);

namespace app\assets;

use yii\web\YiiAsset;
use yii\web\AssetBundle;

final class FetchAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'dist/fetch/index.js'
    ];
    public $depends = [
        YiiAsset::class,
    ];
}
