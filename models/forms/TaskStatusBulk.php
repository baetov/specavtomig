<?php

namespace app\models\forms;

use app\models\Task;
use yii\base\Model;

/**
 * Class TaskStatusBulk
 * @package app\models\forms
 */
class TaskStatusBulk extends Model
{
    /**
     * @var array
     */
    public $pks;

    /**
     * @var int
     */
    public $status;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'required'],
            [['pks'], 'string'],
            [['status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pks' => 'Задачи',
            'status' => 'Статус',
        ];
    }

    /**
     * @return boolean
     */
    public function change()
    {
        if($this->validate()){
            $pks = explode(',', $this->pks);
            Task::updateAll(['task_status_id' => $this->status], ['id' => $pks]);

            return true;
        }

        return false;
    }
}