<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class LightGalleryAsset extends AssetBundle
{
    public $sourcePath = '@bower/lightgallery/dist';

    public $css = [
        'css/lightgallery.min.css',
    ];

    public $js = [
        'js/lightgallery.min.js'
    ];

    public $depends = [
        \yii\web\YiiAsset::class
    ];
}
