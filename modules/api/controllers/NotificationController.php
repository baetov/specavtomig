<?php

namespace app\modules\api\controllers;

use app\components\helpers\Notifier;
use app\models\Commitment;
use app\models\Deal;
use app\models\DealToUser;
use app\models\DealUserField;
use app\models\NotificationTemplate;
use app\models\Task;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\rest\ActiveController;
use yii\web\Response;
use app\models\User;

/**
 * Default controller for the `api` module
 */
class NotificationController extends ActiveController
{
    public $modelClass = 'app\models\Api';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\ContentNegotiator',
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
    }

    public function actionSendDayNotification()
    {
        $tomorow = date('Y-m-d', time() + 86400);



        $tasks = Task::find()->where(['deadline' => $tomorow])->all();
        foreach ($tasks as $task)
        {
            $executor = User::findOne($task->executor_id);
            if($executor)
            {
                $template = NotificationTemplate::find()->where(['action' => NotificationTemplate::ACTION_TASK_EXPIRE])->one();
                \app\components\Notifier::notify($executor, $template->name, $template->text, $task);
            }
        }


        $tasks = Deal::find()->where(['deadline' => $tomorow])->all();
        foreach ($tasks as $task)
        {
            $userPks = ArrayHelper::getColumn(DealToUser::find()->where(['deal_id' => $task->id])->all(), 'user_id');

            $executors = User::find()->where(['id' => $userPks])->all();

            foreach ($executors as $executor)
            {
                $template = NotificationTemplate::find()->where(['action' => NotificationTemplate::ACTION_DEAL_EXPIRE])->one();
                \app\components\Notifier::notify($executor, $template->name, $template->text, $task);
            }
        }


        $tasks = Commitment::find()->where(['end_date' => $tomorow])->all();
        foreach ($tasks as $task)
        {
            $executor = User::findOne($task->executor_side_id);
            if($executor)
            {
                $template = NotificationTemplate::find()->where(['action' => NotificationTemplate::COMMITMENT_EXPIRE_LAST_DAY])->one();
                \app\components\Notifier::notify($executor, $template->name, $template->text, $task);
            }
        }




        $commitments = Commitment::find()->all();
        foreach ($commitments as $commitment)
        {
            $date = date('Y-m-d', strtotime($commitment->end_date) - intval($commitment->notify_day));

            if(date('Y-m-d') == $date){
                $executor = User::findOne($commitment->executor_side_id);
                if($executor)
                {
                    $template = NotificationTemplate::find()->where(['action' => NotificationTemplate::COMMITMENT_EXPIRE])->one();
                    \app\components\Notifier::notify($executor, $template->name, $template->text, $commitment);
                }
            }
        }

    }

    public function actionSendExpireNotification()
    {
        $today = date('Y-m-d');

        $tasks = Task::find()->where(['or', ['deadline' => $today], ['<', 'deadline', $today]])->all();
        foreach ($tasks as $task)
        {
            $executor = User::findOne($task->executor_id);
            if($executor)
            {
                $template = NotificationTemplate::find()->where(['action' => NotificationTemplate::ACTION_TASK_EXPIRED])->one();
                \app\components\Notifier::notify($executor, $template->name, $template->text, $task);
            }
        }


        $tasks = Deal::find()->where(['or', ['deadline' => $today], ['<', 'deadline', $today]])->all();
        foreach ($tasks as $task)
        {
            $userPks = ArrayHelper::getColumn(DealToUser::find()->where(['deal_id' => $task->id])->all(), 'user_id');

            $executors = User::find()->where(['id' => $userPks])->all();

            foreach ($executors as $executor)
            {
                $template = NotificationTemplate::find()->where(['action' => NotificationTemplate::ACTION_DEAL_EXPIRE])->one();
                \app\components\Notifier::notify($executor, $template->name, $template->text, $task);
            }
        }


//        $tasks = Commitment::find()->where(['or', ['deadline' => $today], ['>', 'deadline', $today]])->all();
        $commitments = Commitment::find()->where(['!=', 'execution_status', 'Исполнено'])->all();
        foreach ($commitments as $commitment)
        {
            if($commitment->receiving_date){
                $date = $commitment->receiving_date;
            } else {
                $date = $commitment->receiving_date;
            }


            if(date('Y-m-d') == $date && date('Y-m-d') >= $date){
                $executor = User::findOne($commitment->executor_side_id);
                if($executor)
                {
                    $template = NotificationTemplate::find()->where(['action' => NotificationTemplate::COMMITMENT_EXPIRED])->one();
                    \app\components\Notifier::notify($executor, $template->name, $template->text, $commitment);
                }
            }
        }
    }
}
