<?php

namespace app\components\helpers;

use app\models\Notification;
use app\models\User;
use Yii;


/**
 * Class Notifier
 * @package app\components\helpers
 */
class Notifier
{
    /**
     * @param User|User[] $to
     * @param string $subject
     * @param string $text
     */
    public static function notify($to, $subject, $text)
    {
        if(is_array($to)){
            $emails = [];
            foreach ($to as $t){

                if(in_array($t->login, $emails)){
                    continue;
                }

                $emails[] = $t->login;
                self::send($t, $subject, $text);
            }
        } else {
            self::send($to, $subject, $text);
        }
    }

    /**
     * @param User|User[] $to
     * @param string $subject
     * @param string $text
     */
    private static function send($to, $subject, $text)
    {
        try {
            \Yii::warning($subject, 'Subject of email notification');
            \Yii::warning($text, 'Content of email notification');

            Yii::$app->mailer->compose()
                ->setTo($to->login)
                ->setFrom('project@shop-crm.ru')
                ->setSubject($subject)
                ->setHtmlBody($text)
                ->send();
        } catch (\Exception $e)
        {
            Yii::warning($e->getMessage(), 'Email sending failed');
        }
    }
}