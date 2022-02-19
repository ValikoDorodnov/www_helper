<?php

declare(strict_types=1);

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\YiiAsset;

final class TransformerAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'dist/transformer/index.js'
    ];
    public $depends = [
        YiiAsset::class,
    ];
}
