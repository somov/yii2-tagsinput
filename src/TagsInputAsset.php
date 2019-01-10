<?php

namespace somov\tagsinput;

/**
 * Asset bundle for tagsinput Widget
 *
 */
class TagsInputAsset extends \yii\web\AssetBundle
{
    public $css = [
        'bootstrap-tagsinput.css',
    ];

    public $js = [
        'bootstrap-tagsinput.js',
        //'bootstrap-tagsinput.min.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'somov\tagsinput\TypeaheadAsset'
    ];

    public function init()
    {
        $this->sourcePath = \Yii::getAlias('@vendor/life2016/bootstrap-tagsinput/dist');
        parent::init();
    }
}
