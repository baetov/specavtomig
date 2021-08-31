<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Driver */
?>
<div class="driver-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'type',
            'name',
            'birth',
            'passport',
            'driver_license',
            'crane_license',
        ],
    ]) ?>

</div>
