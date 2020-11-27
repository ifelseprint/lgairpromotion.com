<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class CleanandcoolpromotionAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/cleanandcoolpromotion/app.css',
    ];
    public $js = [
        'js/cleanandcoolpromotion/app.js'
    ];
    public $depends = [
    	'frontend\assets\AppAsset'
    ];
}
