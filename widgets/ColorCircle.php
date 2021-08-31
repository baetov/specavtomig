<?php

namespace app\widgets;

use app\components\helpers\ColorManager;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\Html;

/**
 * Class ColorCircle
 * @package app\widgets
 */
class ColorCircle extends Widget
{
    /**
     * @var string
     */
    public $color;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if($this->color == null){
            throw new InvalidConfigException('color must be required');
        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        parent::run();

        $color = $this->color;
        $border = ColorManager::darkenColor($color, 1.2);

        return Html::tag('span', '', ['style' => "display: inline-block; background: {$color}; border: 2px solid {$border}; border-radius: 100%; width: 15px; height: 15px;"]);
    }
}