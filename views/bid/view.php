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
                        'value' => function($model){
                            return \yii\helpers\ArrayHelper::getValue(\app\models\TechnicType::find()->where(['id' => $model->technic_type_id])->one(),'name');
                        }
                    ],
                    [
                        'attribute' => 'technic_type_subgroup_id',
                        'value' => function($model){
                            return \yii\helpers\ArrayHelper::getValue(\app\models\TechnicTypeSubgroup::find()->where(['id' => $model->technic_type_subgroup_id])->one(),'name');
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
                    [
                        'attribute' => 'pay_status',
                        'value' => function($model){
                            if ($model->pay_status ==  0){
                                return  "Не оплачено";
                            }
                            elseif ($model->pay_status == 1){
                                return  "Частично оплачено";
                            }
                            elseif ($model->pay_status == 2){
                                return  "Оплачено";
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
                    'garage_out',
                    'garage_in',
                    'customer_in',
                    'customer_out',
                ],
            ]) ?>
        </div>
    </div>


</div>
