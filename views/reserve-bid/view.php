<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ReserveBid */
?>
<div class="reserve-bid-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'client_id',
            'technic_type_id',
            'technic_type_subgroup_id',
            'technic_id',
            'work_kind_id',
            'date',
            'time',
            'driver_id',
            'route:ntext',
            'pay_form',
            'price',
            'hours',
            'mkad',
            'mkad_price',
            'total',
            'comment:ntext',
        ],
    ]) ?>

</div>
