<?php

namespace app\components\helpers;


/**
 * Занимается обработкой текста с тэгами
 * Class TagHelper
 * @package app\components\helpers
 */
class TagHelper
{

    const LEFT_PRETAG = '{';
    const RIGHT_PRETAG = '}';

    /**
     * Обрабатывают строку по модели
     * @param string $text
     * @param \yii\base\Model|\yii\base\Model[] $model
     * @return string
     */
    public static function handleModel($text, $model)
    {
        $output = $text;

        if(!is_array($model) && $model instanceof \yii\base\Model)
        {
            $className = self::getClassName($model);
            $tags = [];

            foreach ($model->attributes as $name => $value)
            {
                $tags[self::LEFT_PRETAG."{$className}.{$name}".self::RIGHT_PRETAG] = $value;
            }

            $output = str_ireplace(array_keys($tags), array_values($tags), $output);

        } else if (is_array($model))
        {
            foreach ($model as $modelItem)
            {
                $className = self::getClassName($modelItem);
                $tags = [];

                foreach ($modelItem->attributes as $name => $value)
                {
                    $tags[self::LEFT_PRETAG."{$className}.{$name}".self::RIGHT_PRETAG] = $value;
                }

                $output = str_ireplace(array_keys($tags), array_values($tags), $output);
            }

        }

        return $output;
    }

    /**
     * Обрабатывают строку по справочнику
     * @param string $text
     * @param \app\models\TemplateMessages[] $templateMessages
     * @return string
     */
    public static function handleTemplateMessages($text, $templateMessages)
    {
        $output = $text;

        foreach ($templateMessages as $templateMessage) {
            $contents = $templateMessage->templateMessagesContents;
            $count = count($contents);

            $number = rand(0, $count-1);

            $content = $contents[$number]->content;

            $output = str_replace($templateMessage->tag, $content, $output);
        }

        return $output;
    }

    /**
     * @param \yii\base\Model $model
     * @return string
     */
    private static function getClassName($model)
    {
        return lcfirst(\yii\helpers\StringHelper::basename(get_class($model)));
    }
}