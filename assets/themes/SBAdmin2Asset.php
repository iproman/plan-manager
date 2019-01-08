<?php
/**
 * Created by PhpStorm.
 * User: iproman
 * Date: 30.12.2018
 * Time: 17:25
 */

namespace app\assets\themes;

use yii\web\AssetBundle;

class SBAdmin2Asset extends AssetBundle
{
    public $sourcePath = '@app/assets/themes/startbootstrap-sb-admin-2-gh-pages';
    public $css = [
        // MetisMenu CSS
        'vendor/metisMenu/metisMenu.min.css',
        //  Custom CSS
        'dist/css/sb-admin-2.css',
        'dist/css/override.css',
        // Morris Charts CSS
        'vendor/morrisjs/morris.css',
    ];
    public $js = [
        // Metis Menu Plugin JavaScript
        'vendor/metisMenu/metisMenu.min.js',
        // Morris Charts JavaScript
        'vendor/raphael/raphael.min.js',
        'vendor/morrisjs/morris.min.js',
        'data/morris-data.js',
        // Custom Theme JavaScript
        'dist/js/sb-admin-2.js',
    ];
    public $depends = [
        'app\assets\AppAsset',
    ];
    public $publishOptions = [
        'except' => [
            '*.html',
        ],
    ];
}