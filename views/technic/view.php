<?php

use app\models\MultiTechSubgroup;
use app\models\TechnicType;
use app\models\TechnicTypeSubgroup;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Technic */
?>
<div class="technic-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'model',
            'gos_num',
            'characteristics',
            'equipment',
            [
                'attribute' => 'type_id',
                'value' => function($model){
                    return ArrayHelper::getValue(TechnicType::find()->where(['id' => $model->type_id])->one(),'name');
                }
            ],
            [
                'attribute' => 'subgroups',
                'value' => function($model){
                     $subs = ArrayHelper::getColumn(MultiTechSubgroup::find()->where(['technic_id' => $model->id])->all(),'subgroup_id');
                     $subsName = ArrayHelper::getColumn(TechnicTypeSubgroup::find()->where(['id' => $subs])->all(),'name');
                     return implode(' , ',$subsName);
                }
            ],
        ],
    ]) ?>

</div>
