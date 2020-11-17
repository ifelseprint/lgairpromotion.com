<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class PrivacyPolicyAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/privacy-policy.css',
    ];
    public $js = [
    ];
    public $depends = [
        'frontend\assets\AppAsset'
    ];
}
