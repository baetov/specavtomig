<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ColorAdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/theme';
    public $css = [
        //  'assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet',
        'assets/plugins/bootstrap/css/bootstrap.min.css',
        'assets/plugins/font-awesome/css/font-awesome.min.css',
        'assets/css/animate.min.css',
        'assets/css/style.min.css',
        'assets/css/style-responsive.min.css',
        'assets/css/theme/default.css',
        'assets/plugins/bootstrap-wizard/css/bwizard.min.css'

    ];
    public $js = [
        'assets/plugins/jquery/jquery-migrate-1.1.0.min.js',
        'assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js',
        'assets/plugins/bootstrap/js/bootstrap.min.js',
        'assets/plugins/jquery-cookie/jquery.cookie.js',
        'assets/js/table-manage-combine.demo.min.js',
        'assets/js/apps.min.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
    ];
}
