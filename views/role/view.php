<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Role */
?>
<div class="role-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute' => 'order_create',
                'value' => function($model){
                    if ($model->order_create == 0){
                        return  "Нет";
                    }
                    elseif ($model->order_create == 1){
                        return  "Да";
                    }else{
                        return 0;
                    }
                }
            ],
            [
                'attribute' => 'order_update',
                'value' => function($model){
                    if ($model->order_update == 0){
                        return  "Нет";
                    }
                    elseif ($model->order_update == 1){
                        return  "Да";
                    }else{
                        return 0;
                    }
                }
            ],
            [
                'attribute' => 'order_delete',
                'value' => function($model){
                    if ($model->order_delete == 0){
                        return  "Нет";
                    }
                    elseif ($model->order_delete == 1){
                        return  "Да";
                    }else{
                        return 0;
                    }
                }
            ],
            [
                'attribute' => 'order_view',
                'value' => function($model){
                    if ($model->order_view == 0){
                        return  "Нет";
                    }
                    elseif ($model->order_view == 1){
                        return  "Да";
                    }else{
                        return 0;
                    }
                }
            ],
            [
                'attribute' => 'order_view_all',
                'value' => function($model){
                    if ($model->order_view_all == 0){
                        return  "Нет";
                    }
                    elseif ($model->order_view_all == 1){
                        return  "Да";
                    }else{
                        return 0;
                    }
                }
            ],
            [
                'attribute' => 'directory_access',
                'value' => function($model){
                    if ($model->directory_access == 0){
                        return  "Нет";
                    }
                    elseif ($model->directory_access == 1){
                        return  "Да";
                    }else{
                        return 0;
                    }
                }
            ],
        ],
    ]) ?>

</div>
