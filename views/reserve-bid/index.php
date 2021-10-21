<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReserveBidSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reserve Bids';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-inverse reserve-bid-index">
            <div class="panel-heading">
                <div class="row"style="margin-bottom: -10px">
                    <div class="col-md-1">
                        <h4 class="panel-title">Резервные заявки</h4>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div id="ajaxCrudDatatable">
                    <?= GridView::widget([
                        'id' => 'crud-datatable',
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
//                        'resizableColumns'=>true,
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
    'options' => ['class' => 'modal-slg','tabindex' =>false,],
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
