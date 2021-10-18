<?php

use app\models\Driver;
use app\models\Technic;
use app\models\Client;
use app\models\TechnicType;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BidSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заявки';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Фильтры</h4>
                <div class="panel-heading-btn" style="margin-top:-20px;overflow-y: auto;">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"  data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin(['method' => 'GET']); ?>
                <div class="col-md-3">
                    <?= $form->field($searchModel, 'client_id')->widget(Select2::classname(), [
                        'data' =>  ArrayHelper::map(Client::find()->all(), 'id', 'name'),
                        'language' => 'ru',
                        'options' => ['placeholder' => ' '],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($searchModel, 'technic_type_id')->widget(Select2::classname(), [
                        'data' =>  ArrayHelper::map(TechnicType::find()->all(), 'id', 'name'),
                        'language' => 'ru',
                        'options' => ['placeholder' => ''],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>
                <div class="col-md-3">
                     <?= $form->field($searchModel, 'technic_id')->widget(Select2::classname(), [
                        'data' =>  ArrayHelper::map(Technic::find()->all(), 'id', 'name'),
                        'language' => 'ru',
                         'options' => ['placeholder' => ''],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($searchModel, 'garage_out')->input('date') ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($searchModel, 'driver_id')->widget(Select2::classname(), [
                        'data' =>  ArrayHelper::map(Driver::find()->all(), 'id', 'name'),
                        'language' => 'ru',
                        'options' => ['placeholder' => ''],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($searchModel, 'status')->widget(Select2::classname(), [
                        'data' =>  [
                            0 => 'Резерв',
                            1 => 'Подтверждена',
                            2 => 'В работе',
                            3 => 'Завершена'
                        ],
                        'language' => 'ru',
                        'options' => ['placeholder' => ''],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($searchModel, 'pay_status')->widget(Select2::classname(), [
                        'data' =>  [
                            0 => 'Не оплачено',
                            1 => 'Частично оплачено',
                            2 => 'Оплачено'
                        ],
                        'language' => 'ru',
                        'options' => ['placeholder' => ''],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>

                <div class="col-md-12">
                    <?= Html::a('Сбросить', ['bid/index'], ['class' => 'btn btn-default']) ?>
                    <?= Html::submitButton('Применить', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-inverse bid-index">
            <div class="panel-heading">
                <div class="row"style="margin-bottom: -10px">
                    <div class="col-md-1">
                        <h4 class="panel-title">Заявки</h4>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div id="ajaxCrudDatatable">
                    <?= GridView::widget([
                        'id' => 'crud-datatable',
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'responsiveWrap' => false,
                        'pjax' => true,
                        'columns' => require(__DIR__ . '/_columns.php'),
                        'panelBeforeTemplate' => Html::a('Добавить <i class="fa fa-plus"></i>', ['create'],
                                [
                                    'role' => 'modal-remote',
                                    'title' => 'Добавить компанию',
                                    'class' => 'btn btn-success'
                                ]) . '&nbsp;' .
                            Html::a('<i class="fa fa-repeat"></i>', [''],
                                ['data-pjax' => 1, 'class' => 'btn btn-white', 'title' => 'Обновить']),

                        'striped' => true,
                        'condensed' => true,
                        'responsive' => true,
                        'panel' => [
                            'headingOptions' => ['style' => 'display: none;'],
                            'after' => BulkButtonWidget::widget([
                                    'buttons' => Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Удалить',
                                        ["bulk-delete"],
                                        [
                                            "class" => "btn btn-danger btn-xs",
                                            'role' => 'modal-remote-bulk',
                                            'data-confirm' => false,
                                            'data-method' => false,// for overide yii data api
                                            'data-request-method' => 'post',
                                            'data-confirm-title' => 'Вы уверены?',
                                            'data-confirm-message' => 'Вы действительно хотите удалить данный элемент?'
                                        ]),
                                ]) .
                                '<div class="clearfix"></div>',
                        ]
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    'options' => ['class' => 'modal-slg'],
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
