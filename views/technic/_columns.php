<?php

use app\models\MultiTechSubgroup;
use app\models\TechnicType;
use app\models\TechnicTypeSubgroup;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\User;

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
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'gos_num',
//    ],
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
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'subgroups',
//        'value' => function($data){
//            $subs = ArrayHelper::getColumn(MultiTechSubgroup::find()->where(['technic_id' => $data->id])->all(),'subgroup_id');
//            $subsName = ArrayHelper::getColumn(TechnicTypeSubgroup::find()->where(['id' => $subs])->all(),'name');
//            return implode(' , ',$subsName);
//        }
//    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'characteristics',
//    ],
        [
            'class'=>'\kartik\grid\DataColumn',
            'attribute'=>'reserve',
            'value' => function($data){
                if($data->reserve == 0){
                    return "<p class='badge col-md-12' style='background-color:green'>Свободен</p>";
                }else{
                    return "<p class='badge col-md-12' style='background-color:red'>Занят</p>";
                }
            },
            'format' => 'html',
            'filter' => [
                 0 => 'Свободен',
                 1 => 'Занят'
            ]
        ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'reserved_by',
         'value' => function($data){
             if(!$data->reserved_by == null){
                 return ArrayHelper::getValue(User::find()->where(['id' => $data->reserved_by])->one(),'name');
             }else{
                 return '';
             }
         },
         'filter' => false
     ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Действия',
        'content' => function($model){
            $view = Html::a('<i class="fa fa-eye" style="font-size: 16px;"></i>', ['technic/view', 'id' => $model->id],
                ['role'=>'modal-remote','title'=>'Просмотр', 'data-toggle'=>'tooltip']
            );
            $update = Html::a('<i class="fa fa-pencil" style="font-size: 16px;"></i>', ['technic/update', 'id' => $model->id],
                ['role'=>'modal-remote','title'=>'Изменить', 'data-toggle'=>'tooltip','style' => 'margin-left: 10px;',]
            );
            $delete = Html::a('<i class="fa fa-trash text-danger" style="font-size: 16px;"></i>', ['technic/delete', 'id' => $model->id, 'containerPjaxReload'=>'#pjax-container'],[
                'role'=>'modal-remote','title'=>'Удалить',
                'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                'data-request-method'=>'post',
                'data-toggle'=>'tooltip',
                'data-confirm-title'=>'Вы уверены?',
                'data-confirm-message'=>'Вы действительно хотите удалить файл',
                'style' => 'margin-left: 10px;',
            ]);
            if ($model->reserve == false){
                $take =  Html::a('<i class="fa fa-check text-success" style="font-size: 16px;"></i>', ['technic/take', 'id' => $model->id, 'containerPjaxReload'=>'#pjax-container'],[
                    'role'=>'modal-remote','title'=>'Забронировать',
                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                    'data-request-method'=>'post',
                    'data-toggle'=>'tooltip',
                    'data-confirm-title'=>'Вы уверены?',
                    'data-confirm-message'=>'Вы действительно хотите Забронировать',
                    'style' => 'margin-left: 10px;',
                ]);
                return $view . $update . $take . $delete;

            }elseif ($model->reserve == true){
                $free =  Html::a('<i class="fa fa-times text-danger" style="font-size: 16px;"></i>', ['technic/free', 'id' => $model->id, 'containerPjaxReload'=>'#pjax-container'],[
                    'role'=>'modal-remote','title'=>'Освободить',
                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                    'data-request-method'=>'post',
                    'data-toggle'=>'tooltip',
                    'data-confirm-title'=>'Вы уверены?',
                    'data-confirm-message'=>'Вы действительно хотите освободить от брони?',
                    'style' => 'margin-left: 10px;',
                ]);
                return $view . $update . $free . $delete  ;

            }else{
                return $view . $update . $delete;
            }
        }
    ],
];   