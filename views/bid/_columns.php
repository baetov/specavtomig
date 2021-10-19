<?php

use app\models\Client;
use app\models\Technic;
use app\models\TechnicType;
use app\models\TechnicTypeSubgroup;
use app\models\WorkKind;
use app\models\WorkType;
use kartik\grid\GridView;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

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
        'attribute'=>'client_id',
        'value' => function($data){
            return ArrayHelper::getValue(Client::find()->where(['id' => $data->client_id])->one(),'name');
        },
        'hAlign' => GridView::ALIGN_CENTER,
        'filter' => false
    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'technic_type_id',
//        'value' => function($data){
//            return ArrayHelper::getValue(TechnicType::find()->where(['id' => $data->technic_type_id])->one(),'name');
//        },
//        'filter' => ArrayHelper::map(TechnicType::find()->all(),'id','name'),
//        'filterType' => GridView::FILTER_SELECT2,
//        'filterWidgetOptions' => [
//            'options' => ['prompt' => ''],
//            'pluginOptions' => ['allowClear' => true],
//        ],
//    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'technic_type_subgroup_id',
//        'value' => function($data){
//            return ArrayHelper::getValue(TechnicTypeSubgroup::find()->where(['id' => $data->technic_type_subgroup_id])->one(),'name');
//        },
//        'filter' => ArrayHelper::map(TechnicTypeSubgroup::find()->all(),'id','name'),
//        'filterType' => GridView::FILTER_SELECT2,
//        'filterWidgetOptions' => [
//            'options' => ['prompt' => ''],
//            'pluginOptions' => ['allowClear' => true],
//        ],
//    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'technic_id',
        'format' => 'raw',
        'hAlign' => GridView::ALIGN_CENTER,
        'value' => function($data){
            return ArrayHelper::getValue(Technic::find()->where(['id' => $data->technic_id])->one(),'name');
        },
        'filter' => false,
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'garage_out',
        'hAlign' => GridView::ALIGN_CENTER,
        'format' =>  ['date', 'd-M-Y H:i'],
        'filter' => false
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'customer_in',
        'hAlign' => GridView::ALIGN_CENTER,
        'format' =>  ['date', 'd-M-Y H:i'],
        'filter' => false
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'customer_out',
        'hAlign' => GridView::ALIGN_CENTER,
        'format' =>  ['date', 'd-M-Y H:i'],
        'filter' => false
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'garage_in',
        'hAlign' => GridView::ALIGN_CENTER,
        'format' =>  ['date', 'd-M-Y H:i'],
        'filter' => false
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'hours',
        'hAlign' => GridView::ALIGN_CENTER,
        'filter' => false
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'price',
        'hAlign' => GridView::ALIGN_CENTER,
        'filter' => false
    ],

    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'mkad',
        'hAlign' => GridView::ALIGN_CENTER,
        'filter' => false
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'mkad_price',
        'hAlign' => GridView::ALIGN_CENTER,
        'filter' => false
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'total',
        'hAlign' => GridView::ALIGN_CENTER,
        'filter' => false
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'pay_form',
        'hAlign' => GridView::ALIGN_CENTER,
        'filter' => false
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'work_kind_id',
        'hAlign' => GridView::ALIGN_CENTER,
        'value' => function($data){
            return ArrayHelper::getValue(WorkKind::find()->where(['id' => $data->work_kind_id])->one(),'name');
        },
        'filter' => false
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'work_type_id',
        'hAlign' => GridView::ALIGN_CENTER,
        'value' => function($data){
            return ArrayHelper::getValue(WorkType::find()->where(['id' => $data->work_type_id])->one(),'name');
        },
        'filter' => false
    ],

     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'route',
         'hAlign' => GridView::ALIGN_CENTER,
         'filter' => false
     ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'fuel',
        'filter' => false
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'date',
        'hAlign' => GridView::ALIGN_CENTER,
        'filter' => false
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'status',
        'hAlign' => GridView::ALIGN_CENTER,
        'content' => function($data){
            if ($data->status == 0){
                return  "Резерв";
            }
            elseif ($data->status == 1){
                return  "Подтверждена";
            }
            elseif ($data->status == 2){
                return  "В работе";
            }
            elseif ($data->status == 3){
                return  "Завершена";
            }
            else{
                return 0;
            }
        },
        'filter' => false
    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'pay_status',
//        'hAlign' => GridView::ALIGN_CENTER,
//        'content' => function($data){
//            if ($data->pay_status == 0){
//                return  "Не оплачено";
//            }
//            elseif ($data->pay_status == 1){
//                return  "Частично оплачено";
//            }
//            elseif ($data->pay_status == 2){
//                return  "Оплачено";
//            }
//            else{
//                return 0;
//            }
//        },
//        'filter' => [
//            0 => 'Не оплачено',
//            1 => 'Частично оплачено',
//            2 => 'Оплачено',
//        ],
//        'filterType' => GridView::FILTER_SELECT2,
//        'filterWidgetOptions' => [
//            'options' => ['prompt' => ''],
//            'pluginOptions' => ['allowClear' => true],
//        ],
//    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'comment',
    ],
//     [
//         'class'=>'\kartik\grid\DataColumn',
//         'attribute'=>'mileage',
//     ],

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