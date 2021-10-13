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
            [
                'attribute' => 'type',
                'value' => function($model){
                    if ($model->type == 1){
                        return  "Водитель тягача";
                    }
                    elseif ($model->type == 2){
                        return  "Водитель автокарна";
                    }
                    elseif ($model->type == 3){
                        return  "Водитель манипулятора";
                    }else{
                        return 0;
                    }
                }
            ],
            'name',
            'phone',
            'birth',
            'passport',
            'driver_license',
            'crane_license',
        ],
    ]) ?>

</div>
