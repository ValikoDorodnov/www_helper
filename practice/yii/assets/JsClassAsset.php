<?php

declare(strict_types=1);

namespace app\assets;

use yii\web\AssetBundle;

final class JsClassAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/jsClasses/index.js'
    ];
    public $depends = [
    ];
}