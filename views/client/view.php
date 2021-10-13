<?php

use app\models\ClientContact;
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
            [
                'attribute' => 'contacts',
                'value' => function($model){
                    $contacts = ClientContact::find()->where(['client_id' => $model->id])->all();
                    $contactFace = [];
                    foreach ($contacts as $contact){
                        $contactFace[] .= $contact->name . ' - ' . $contact->phone;
                    }
                    return implode(' , ',$contactFace);
                }
            ],
            'address',
            'post_index',
            'inn',
            'ogrn',
            'kpp',
            'official_address',
            [
                'attribute' => 'address_equals',
                'value' => function($model){
                    if ($model->address_equals == 1){
                        return  "Да";
                    }
                    elseif ($model->address_equals == 0){
                        return  "Нет";
                    }
                    else{
                        return 0;
                    }
                }
            ],
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
