<?php

namespace app\bootstrap;

use kartik\grid\GridView;
use Yii;


/**
 * Class AppBootstrap
 * @package app\bootstrap
 */
class AppBootstrap implements \yii\base\BootstrapInterface
{

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param \yii\base\Application $app the application currently running
     */
    public function bootstrap($app)
    {
        Yii::$container->set(GridView::className(), [
            'containerOptions' => ['style' => 'width: 99%;'],
            'responsive' => true,
            'responsiveWrap' => false,
        ]);
    }
}