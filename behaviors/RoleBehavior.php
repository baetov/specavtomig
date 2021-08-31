<?php

namespace app\behaviors;

use Yii;
use yii\base\Behavior;
use yii\base\Event;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

/**
 * Class RoleBehavior
 * @package app\behaviors
 */
class RoleBehavior extends Behavior
{
    /**
     * @var array
     */
    public $actions;

    /**
     * @inheritdoc
     */
    public function events()
    {
        return [Controller::EVENT_BEFORE_ACTION => 'beforeAction'];
    }

    /**
     * @param Event $event
     * @throws ForbiddenHttpException
     * @return boolean
     */
    public function beforeAction($event)
    {
        $action = $event->action->id;

        if(isset($this->actions[$action])){
            $permission = $this->actions[$action];

            if(is_array($permission)){
                foreach ($permission as $per){
                    if(Yii::$app->user->identity->can($per) == true){
                        return true;
                    }
                }
                throw new ForbiddenHttpException('У вас не достаточно прав');
            } else {
                if(Yii::$app->user->identity->can($permission) == false){
                    throw new ForbiddenHttpException('У вас не достаточно прав');
                }
            }
        }
        return true;
    }
}