<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class Lgcovid19careAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/lgcovid19care/app.css',
    ];
    public $js = [
        'js/lgcovid19care/app.js'
    ];
    public $depends = [
    	'frontend\assets\AppAsset'
    ];
}
