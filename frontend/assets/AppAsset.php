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
        'css/bootstrap.min.css',
        'common/assets/owlcarousel/assets/owl.carousel.min.css',
        'css/style.css',
        'css/media.css',
        'https://fonts.googleapis.com/css?family=Lato:300,400,700,400italic,300italic',
    ];
    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js',
        'js/bootstrap.min.js',
        'js/fixed_bar.js',
        'js/common.js',
        'common/assets/owlcarousel/owl.carousel.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
