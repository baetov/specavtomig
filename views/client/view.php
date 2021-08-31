<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Client */
?>
<div class="client-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'address',
            'post_index',
            'type',
            'created_at',
            'inn',
            'ogrn',
            'kpp',
            'official_address',
            'address_equals',
            'director',
            'email:email',
            'phone',
            'site',
            'bank_bik',
            'bank_name',
            'bank_address',
            'bank_correspondent_account',
            'bank_register_number',
            'bank_registration_date',
            'bank_payment_account',
        ],
    ]) ?>

</div>
