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
        'common/assets/vendors/jquery.min.js',
        'common/js/bootstrap.min.js',
        'https://code.jquery.com/jquery-3.2.1.slim.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js',
        'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js',
        'common/assets/vendors/highlight.js',
        'common/assets/owlcarousel/owl.carousel.js',
        'common/assets/js/app.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
