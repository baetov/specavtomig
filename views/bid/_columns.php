<?php

use app\models\Client;
use app\models\Driver;
use app\models\Technic;
use app\models\TechnicType;
use app\models\TechnicTypeSubgroup;
use app\models\WorkKind;
use app\models\WorkType;
use kartik\grid\GridView;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;


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
        'attribute'=>'date',
        'value' => function($data) {
            if($data->date == null){
                return Html::tag('div', 'Необходимо задать дату!', ['style' => ['color' => 'red']]);
            }else{
                $date = New DateTime($data->date);
                return date_format($date,'d.m.Y');
            }
        },
        'hAlign' => GridView::ALIGN_CENTER,
        'filter' => false,
        'format' => 'html'
    ],
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
//        'label'=>'Техника и водитель',
//        'value' => function($data){
//            $tech = ArrayHelper::getValue(Technic::find()->where(['id' => $data->technic_id])->one(),'name');
//            $driver = ArrayHelper::getValue(Driver::find()->where(['id' => $data->driver_id])->one(),'name');
//            return "$tech  <br> $driver";
//        },
//        'hAlign' => GridView::ALIGN_CENTER,
//        'filter' => false,
//        'format' => 'html'
//    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'technic_id',
        'hAlign' => GridView::ALIGN_CENTER,
        'value' => function($data){
            return ArrayHelper::getValue(Technic::find()->where(['id' => $data->technic_id])->one(),'name');
        },
        'filter' => false,
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'driver_id',
        'value' => function($data){
            return ArrayHelper::getValue(Driver::find()->where(['id' => $data->driver_id])->one(),'name');
        },
        'filter' => false
    ],

    [
        'class'=>'\kartik\grid\DataColumn',
        'label'=>'Время',
        'value' => function($data){
            return "$data->garage_out  <br> <span style='background-color:#abf0dd'>$data->customer_in</span> <br><br> <span style='background-color:#abf0dd'>$data->customer_out</span> <br> $data->garage_in";
        },
        'hAlign' => GridView::ALIGN_CENTER,
        'filter' => false,
        'format' => 'html'
    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'garage_out',
//        'label' => 'ИЗ гаража',
//        'hAlign' => GridView::ALIGN_CENTER,
//        'filter' => false
//    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'customer_in',
//        'label' => 'К заказчику',
//        'hAlign' => GridView::ALIGN_CENTER,
//        'filter' => false
//    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'customer_out',
//        'label' => 'ОТ заказчика',
//        'hAlign' => GridView::ALIGN_CENTER,
//        'filter' => false
//    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'garage_in',
//        'label' => 'В гараж',
//        'hAlign' => GridView::ALIGN_CENTER,
//        'filter' => false
//    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'hours',
        'label' => 'час/р',
        'hAlign' => GridView::ALIGN_CENTER,
        'filter' => false
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'price',
        'label' => 'цен./ч',
        'hAlign' => GridView::ALIGN_CENTER,
        'filter' => false
    ],

    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'mkad',
        'label' => 'км',
        'hAlign' => GridView::ALIGN_CENTER,
        'filter' => false
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'mkad_price',
        'label' => 'цен./км',
        'hAlign' => GridView::ALIGN_CENTER,
        'filter' => false
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'pay_form',
        'label' => 'тип ндс',
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
        'attribute'=>'work_kind_id',
        'hAlign' => GridView::ALIGN_CENTER,
        'value' => function($data){
            return ArrayHelper::getValue(WorkKind::find()->where(['id' => $data->work_kind_id])->one(),'name');
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
        'label' => 'Топливо',
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
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'author_id',
        'value' => function($data){
            $author = ArrayHelper::getValue(\app\models\User::find()->where(['id' => $data->author_id])->one(),'name');
            if($data->updated_by !== null){
                $updatedBy = ArrayHelper::getValue(\app\models\User::find()->where(['id' => $data->updated_by])->one(),'name');
                $updatedAt = New DateTime($data->updated_at);
                $updatedAt = date_format($updatedAt,'d-m-Y H:i:s');
                return "Cоздал: <br >$author <br> внес изменения: <br> $updatedBy <br> $updatedAt";
            }else{
                return $author;
            }
        },
        'visible' => Yii::$app->user->identity->isSuperAdmin(),
        'filter' => false,
        'format' => 'html'
    ],
//     [
//         'class'=>'\kartik\grid\DataColumn',
//         'attribute'=>'mileage',
//     ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'template' => '{view} {update} {delete} {clone}',

        'buttons' => [
             'clone' => function ($url,$model,$key) {
                return Html::a(
                    '<i class="fa fa-clone" style="color: red" aria-hidden="true"></i>',[$url,'containerPjaxReload'=>'#pjax-container'],['role'=>'modal-remote','title'=>'Клон','data-toggle'=>'tooltip']
                    );
            },
        ],
        'viewOptions'=>['role'=>'modal-remote','title'=>'Просмотр','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Изменить', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Удалить',
            'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
            'data-request-method'=>'post',
            'data-toggle'=>'tooltip',
            'data-confirm-title'=>'Удаление',
            'data-confirm-message'=>'Вы действительно хотите удалить данный элемент?'],
    ],

//    [
//        'class' => 'kartik\grid\ActionColumn',
//        'dropdown' => false,
//        'vAlign'=>'middle',
//        'urlCreator' => function($action, $model, $key, $index) {
//            return Url::to([$action,'id'=>$key]);
//        },
//        'viewOptions'=>['role'=>'modal-remote','title'=>'Просмотр','data-toggle'=>'tooltip'],
//        'updateOptions'=>['role'=>'modal-remote','title'=>'Изменить', 'data-toggle'=>'tooltip'],
//        'deleteOptions'=>['role'=>'modal-remote','title'=>'Удалить',
//            'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
//            'data-request-method'=>'post',
//            'data-toggle'=>'tooltip',
//            'data-confirm-title'=>'Удаление',
//            'data-confirm-message'=>'Вы действительно хотите удалить данный элемент?'],
//    ],

];   