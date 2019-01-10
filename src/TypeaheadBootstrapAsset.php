<?php
/**
 * Created by PhpStorm.
 * User: develop
 * Date: 10.11.2018
 * Time: 10:41
 */

namespace somov\tagsinput;


use yii\web\AssetBundle;

class TypeaheadBootstrapAsset extends AssetBundle
{
    public $sourcePath = '@bower/bootstrap3-typeahead';

    public $js = [
        'bootstrap3-typeahead.js'
    ];

    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

}