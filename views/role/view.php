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
            'contract_create',
            'contract_update',
            'contract_delete',
            'contract_view',
            'contract_view_all',
            'order_create',
            'order_update',
            'order_delete',
            'order_view',
            'order_view_all',
            'task_create',
            'task_update',
            'task_delete',
            'task_view',
            'task_view_all',
            'directory_access',
            'user_create',
            'user_update',
            'user_delete',
            'user_view',
            'user_view_all',
            'report_access',
        ],
    ]) ?>

</div>
