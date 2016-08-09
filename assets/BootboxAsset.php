<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 05.08.16
 * Time: 10:30
 */

namespace app\assets;

use yii\web\AssetBundle;

class BootboxAsset extends AssetBundle
{
    public $sourcePath = '@vendor/bower/bootbox';

    public $js = [
        'bootbox.js',
    ];
}