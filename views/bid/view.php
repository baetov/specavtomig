<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Bid */
?>
<div class="bid-view">
    <div class="row">
        <div class="col-md-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'client_id',
                        'value' => function($model){
                            return \yii\helpers\ArrayHelper::getValue(\app\models\Client::find()->where(['id' => $model->client_id])->one(),'name');
                        }
                    ],
                    [
                        'attribute' => 'technic_type_id',
                        'label' => 'Тип и подтип техники',
                        'value' => function($model){
                            $type =  \yii\helpers\ArrayHelper::getValue(\app\models\TechnicType::find()->where(['id' => $model->technic_type_id])->one(),'name');
                            $subtype = yii\helpers\ArrayHelper::getValue(\app\models\TechnicTypeSubgroup::find()->where(['id' => $model->technic_type_subgroup_id])->one(),'name');
                            return $type . ' - ' . $subtype;
                         }
                    ],
                    [
                        'attribute' => 'driver_id',
                        'value' => function($model){
                            return \yii\helpers\ArrayHelper::getValue(\app\models\Driver::find()->where(['id' => $model->driver_id])->one(),'name');
                        }
                    ],
                    [
                        'attribute' => 'technic_id',
                        'value' => function($model){
                            return \yii\helpers\ArrayHelper::getValue(\app\models\Technic::find()->where(['id' => $model->technic_id])->one(),'name');
                        }
                    ],
                    [
                        'attribute' => 'work_kind_id',
                        'value' => function($model){
                            return \yii\helpers\ArrayHelper::getValue(\app\models\WorkKind::find()->where(['id' => $model->work_kind_id])->one(),'name');
                        }
                    ],
                    [
                        'attribute' => 'work_type_id',
                        'value' => function($model){
                            return \yii\helpers\ArrayHelper::getValue(\app\models\WorkType::find()->where(['id' => $model->work_type_id])->one(),'name');
                        }
                    ],
                    'route:ntext',
                    [
                        'attribute' => 'status',
                        'value' => function($model){
                            if ($model->status ==  0){
                                return  "Резерв";
                            }
                            elseif ($model->status == 1){
                                return  "Подтверждена";
                            }
                            elseif ($model->status == 2){
                                return  "В работе";
                            }
                            elseif ($model->status == 3){
                                return  "Завершена";
                            }
                            else{
                                return 0;
                            }
                        }
                    ],
                    'date',
                ],
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'pay_form',
                    'price',
                    'hours',
                    'mkad',
                    'mkad_price',
                    'total',
                    'fuel',
                    [
                        'attribute' => 'garage_out',
                        'value' => function($data) {
                            $garage_out = New DateTime($data->garage_out);
                            return date_format($garage_out,'d.m.Y H:i');
                        },
                    ],
                    [
                        'attribute' => 'customer_in',
                        'value' => function($data) {
                            $customer_in = New DateTime($data->customer_in);
                            return date_format($customer_in,'d.m.Y H:i');
                        },
                    ],
                    [
                        'attribute' => 'customer_out',
                        'value' => function($data) {
                            $customer_out = New DateTime($data->customer_out);
                            return date_format($customer_out,'d.m.Y H:i');
                        },
                    ],
                    [
                        'attribute' => 'garage_in',
                        'value' => function($data) {
                            $garage_in = New DateTime($data->garage_in);
                            return date_format($garage_in,'d.m.Y H:i');
                        },
                    ],
                ],
            ]) ?>
        </div>
    </div>


</div>
