<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Scan */
?>
<div class="scan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'loaded_at',
            'link',
            'author_id',
            'user_id',
            'contract_id',
        ],
    ]) ?>

</div>
