<?php
namespace somov\tagsinput;

/**
 *
 * @author Avikaresha Saha <avikarsha.saha@gmail.com>
 */
class TypeAheadAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@bower/typeahead.js/dist';
    public $js = [
        'bloodhound.js',
        'typeahead.jquery.js',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        //'somov\tagsinput\TypeaheadBootstrapAsset'
    ];
}
