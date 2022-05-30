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
                    'route:ntext',
                    [
                        'attribute' => 'date',
                        'value' => function($data) {
                            $date = New DateTime($data->date);
                            return date_format($date,'d.m.Y');
                        },
                    ],
                    'garage_out',
                    'customer_in',
                    'customer_out',
                    'garage_in'

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
                    'details',
                    'comment'
                ],
            ]) ?>
        </div>
    </div>


</div>
