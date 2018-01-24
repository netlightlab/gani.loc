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
        'common/css/bootstrap.min.css',
        'common/css/style.css',
        'common/css/media.css',
        'https://fonts.googleapis.com/css?family=Lato:300,400,700,400italic,300italic',
        'common/assets/owlcarousel/assets/owl.carousel.min.css',
    ];
    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js',
        'common/js/bootstrap.min.js',
        'common/js/fixed_bar.js',
        'common/assets/owlcarousel/owl.carousel.js',
        'common/assets/js/app.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
