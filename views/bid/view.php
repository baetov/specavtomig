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
                    'client_id',
                    'technic_type_id',
                    'technic_type_subgroup_id',
                    'technic_id',
                    'work_kind_id',
                    'work_type_id',
                    'date',
                    'route:ntext',
                    'status',
                    'pay_status',
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
