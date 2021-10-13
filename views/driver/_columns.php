<?php
use yii\helpers\Url;
use kartik\grid\GridView;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'phone',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'type',
        'content' => function($data){
            if ($data->type == 1){
                return  "Водитель тягача";
            }
            elseif ($data->type == 2){
                return  "Водитель автокарна";
            }
            elseif ($data->type == 3){
                return  "Водитель манипулятора";
            }else{
                return 0;
            }
            },
            'filter' => [
                1 => 'Водитель тягача',
                2 => 'Водитель автокарна',
                3 => 'Водитель манипулятора'
            ],
            'filterType' => GridView::FILTER_SELECT2,
            'filterWidgetOptions' => [
                'options' => ['prompt' => ''],
                'pluginOptions' => ['allowClear' => true],
            ],    
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'birth',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'passport',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'driver_license',
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'crane_license',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'Просмотр','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Изменить', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Удалить',
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Удаление',
                          'data-confirm-message'=>'Вы действительно хотите удалить данный элемент?'],
    ],

];   