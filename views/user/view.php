<?php


use app\models\UserType;

use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

?>
<div class="user-view">
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4 class="panel-title">Информация</h4>
            <div class="panel-heading-btn" style="margin-top: -20px;">
                <?= Html::a('<span class="glyphicon glyphicon-pencil "></span>', ['user/update', 'id' => $model->id, 'containerPjaxReload' => '#pjax-user-info-container'], ['role' => 'modal-remote']) ?>
            </div>
        </div>
        <div class="panel-body">
 
    <?php Pjax::begin(['id' => 'pjax-user-info-container', 'enablePushState' => false]); ?>
            <div class="row">
                <div class="col-md-2">
                    <img src="<?=Url::toRoute(['/'.$model->realAvatar])?>" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div class="col-md-5">
                    <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                    [
                    'attribute' => 'type',
                    'value' => function($data){
                    $attrName = '';
                    if ($data['type'] == 0){
                    return $attrName = 'Штатный';
                    }
                    if ($data['type'] == 1){
                    return $attrName = 'Внештатный';
                    }else{
                    return $attrName = 'Подрядчик';
                    }

                    }
                    ],
                    'name',
                    'login:email',

                        [
                            'attribute' => 'address',
                            'visible' => $model->type == 2,
                        ],
                        [
                            'attribute' => 'of_name',
                            'visible' => $model->type == 2,
                        ],
                    [
                    'attribute' => 'user_type',
                    'visible' =>in_array($model->type,[2, 1]),
                    'value' => function($data){
                    $workTypes = ArrayHelper::getColumn(UserType::find()->where(['user_id' => $data->id ])->all(), 'type_id');
                    $workTypes =ArrayHelper::getColumn(WorkType::find()->where(['id' => $workTypes])->all(), 'name');
                    $workTypes = implode(', ', $workTypes);
                    return $workTypes;
                    }
                    ],
                    ],
                    ]) ?>
                </div>



                <div class="col-md-5">
                    <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                    [
                    'attribute' => 'role_id',
                    'value' => ArrayHelper::getValue($model->getRole()->one(),'name')
                    ],
                    'birth_date',
                    'phone',

                    [
                        'attribute' => 'address',
                        'visible' => $model->type == 2,
                    ],
                    [
                    'attribute' => 'user_kind',
                        'visible' =>in_array($model->type,[2, 1]),
                    'value' => function($data){
                    $c = ArrayHelper::getColumn(UserKind::find()->where(['user_id' => $data->id])->all(), 'kind_id');
                    $kinds = ArrayHelper::getColumn(Subgroups::find()->where(['id' => $c])->all(), 'name');
                    $kinds = implode(', ', $kinds);
                    return $kinds;
                    }
                    ]
                    ],
                    ]) ?>
                </div>


            </div>



        </div>
    <?php Pjax::end(); ?>

    </div>



        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Документы</h4>
                        <div class="panel-heading-btn" style="margin-top: -20px;">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>


                    <div class="panel-body" style="height: 500px; overflow-y: auto;">
                        <div class="col-md-12">

                        <?= $this->render('@app/views/user/scan_index.php', [
                            'searchModel' => $scanSearchModel,
                            'dataProvider' => $scanDataProvider,
                            'user_id' => $model->id,
                        ]) ?>
                    </div>
                    </div>
                </div>
            </div>



        </div>
</div>

<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    'options' => ['class' => 'fade modal-slg'],
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>