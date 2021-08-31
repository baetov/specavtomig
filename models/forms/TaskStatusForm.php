<?php

namespace app\models\forms;

use app\models\Task;
use yii\base\Model;

/**
 * Class TaskStatusForm
 * @package app\models\forms
 */
class TaskStatusForm extends Model
{
    public $taskId;

    public $status;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['taskId', 'status'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'status' => 'Статус',
        ];
    }

    /**
     * @inheritdoc
     */
    public function update()
    {
        if($this->validate()){
            Task::updateAll(['task_status_id' => $this->status], ['id' => $this->taskId]);
            return true;
        }
        return false;
    }
}