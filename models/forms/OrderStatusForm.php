<?php

namespace app\models\forms;

use app\models\Order;
use yii\base\Model;

/**
 * Class OrderStatusForm
 * @package app\models\forms
 */
class OrderStatusForm extends Model
{
    public $orderId;

    public $status;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orderId', 'status'], 'required'],
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
            Order::updateAll(['order_status_id' => $this->status], ['id' => $this->orderId]);
            return true;
        }
        return false;
    }
}