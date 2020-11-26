<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class CleanandcoolAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/cleanandcool/app.css',
    ];
    public $js = [
        'js/cleanandcool/app.js'
    ];
    public $depends = [
    	'frontend\assets\AppAsset'
    ];
}
