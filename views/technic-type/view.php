<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TechnicType */
?>
<div class="technic-type-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
        ],
    ]) ?>

</div>
