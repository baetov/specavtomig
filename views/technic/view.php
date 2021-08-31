<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Technic */
?>
<div class="technic-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'model',
            'gos_num',
            'characteristics',
            'equipment',
            'type_id',
        ],
    ]) ?>

</div>
