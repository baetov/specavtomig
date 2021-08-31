<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\WorkKind */
?>
<div class="work-kind-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
        ],
    ]) ?>

</div>
