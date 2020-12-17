<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class TiewtuathaipuricareminiAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/tiewtuathaipuricaremini/app.css',
    ];
    public $js = [
        'js/tiewtuathaipuricaremini/app.js'
    ];
    public $depends = [
    	'frontend\assets\AppAsset'
    ];
}
