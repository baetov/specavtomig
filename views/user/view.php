<?php
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model app\models\User */

?>
<div class="user-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'login',
            'phone',
            'birth_date'
        ],
    ]) ?>
</div>
