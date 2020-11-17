<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'icon/font-awesome/css/font-awesome.min.css',
        'dist/css/adminlte.min.css',
        'plugins/select2/css/select2.min.css',
        'plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css',
        'plugins/daterangepicker/daterangepicker.css',
        'css/loader.css',
        'css/style.css',
    ];
    public $js = [
        'plugins/bootstrap/js/bootstrap.bundle.min.js',
        'plugins/moment/moment.min.js',
        'plugins/select2/js/select2.full.min.js',
        'plugins/daterangepicker/daterangepicker.js',
        'plugins/jquery-validation/jquery.validate.js',
        'plugins/jquery-validation/additional-methods.min.js',
        'dist/js/adminlte.min.js',
        'js/App.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}