<?php

namespace app\components;

use app\components\TagHelper;
use app\models\User;

/**
 * Class Notifier
 * @package app\components
 */
class Notifier
{
    /**
     * @param User $user
     * @param string $subject
     * @param string $text
     * @param IPrintable[]|IPrintable $entities
     * @param array $additionalTags
     */
    public static function notify($user, $subject, $text, $entities, $additionalTags = [])
    {
        if(is_array($entities)){
            foreach ($entities as $entity)
            {
                $tagHelper = new TagsHelper([
                    'printable' => $entity,
                    'content' => $text,
                ]);

                $text = $tagHelper->handle();
            }
        } else {
            $tagHelper = new TagsHelper([
                'printable' => $entities,
                'content' => $text,
            ]);

            $text = $tagHelper->handle();

            $text = strtr($text, $additionalTags);
        }

        $user->sendNotification($subject, $text);
    }
}