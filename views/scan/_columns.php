<?php

use yii\helpers\Html;
use yii\helpers\Url;

return [
//    [
//        'class' => 'kartik\grid\CheckboxColumn',
//        'width' => '20px',
//    ],
//    [
//        'class' => 'kartik\grid\SerialColumn',
//        'width' => '30px',
//    ],
//    [
//         'class'=>'\kartik\grid\DataColumn',
//         'attribute'=>'file_img',
//        'content' =>
//    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'loaded_at',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'author_id',
        'label'=>'Загрузил',
        'value'=>'author.name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Скачать',
        'content' => function($model){
            return Html::a('<i class="fa fa-cloud-download text-success" style="font-size: 30px;"></i>', Url::toRoute(['/'.$model->link]), [
                'target'=>'_blank','data' => ['pjax' => 0]
            ]);
        }
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'contract_id',
    // ],
//    [
//        'class' => 'kartik\grid\ActionColumn',
//        'dropdown' => false,
//        'vAlign'=>'middle',
//        'urlCreator' => function($action, $model, $key, $index) {
//                return Url::to([$action,'id'=>$key]);
//        },
//        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
//        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
//        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete',
//                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
//                          'data-request-method'=>'post',
//                          'data-toggle'=>'tooltip',
//                          'data-confirm-title'=>'Are you sure?',
//                          'data-confirm-message'=>'Are you sure want to delete this item'],
//    ],

];   