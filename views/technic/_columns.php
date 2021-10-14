<?php

use app\models\MultiTechSubgroup;
use app\models\TechnicType;
use app\models\TechnicTypeSubgroup;
use kartik\grid\GridView;
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
        'attribute'=>'name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'gos_num',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'type_id',
        'value' => function($data){
            return ArrayHelper::getValue(TechnicType::find()->where(['id' => $data->type_id])->one(),'name');
        },
        'filter' => ArrayHelper::map(TechnicType::find()->all(),'id','name'),
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'options' => ['prompt' => ''],
            'pluginOptions' => ['allowClear' => true],
        ],
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'subgroups',
        'value' => function($data){
            $subs = ArrayHelper::getColumn(MultiTechSubgroup::find()->where(['technic_id' => $data->id])->all(),'subgroup_id');
            $subsName = ArrayHelper::getColumn(TechnicTypeSubgroup::find()->where(['id' => $subs])->all(),'name');
            return implode(' , ',$subsName);
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'characteristics',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'equipment',
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'type_id',
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