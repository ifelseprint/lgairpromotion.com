<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'plugins/fontawesome-free/css/all.min.css',
        'dist/css/adminlte.min.css',
        'dist/icon/themify-icons/themify-icons.css',
        'dist/icon/icofont/css/icofont.css',
        'dist/icon/feather/css/feather.css',
        'dist/icon/material-design/css/material-design-iconic-font.min.css',
        'plugins/select2/css/select2.min.css',
        'plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css',
        'plugins/daterangepicker/daterangepicker.css',
        'dist/css/style.css',
        'css/loader.css',
        'css/pagination.css',
    ];
    public $js = [
        'plugins/bootstrap/js/bootstrap.bundle.min.js',
        'plugins/moment/moment.min.js',
        'plugins/tinymce/tinymce.min.js',
        'plugins/select2/js/select2.full.min.js',
        'plugins/daterangepicker/daterangepicker.js',
        'dist/js/adminlte.min.js',
        'js/App.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
    ];
}