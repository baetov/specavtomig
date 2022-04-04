<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TechnicSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Техника';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<?php Pjax::begin(['id' => 'pjax-container', 'enablePushState' => false]); ?>
<div class="panel panel-inverse technic-index">
<div class="panel-heading">
    <h4 class="panel-title">Техника</h4>
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
                    ]) . '&nbsp;' . Html::a('Сбросить все <i class="fa fa-repeat"></i>', ['clear','containerPjaxReload'=>'#pjax-container'],
                    [
                        'role' => 'modal-remote',
                        'title' => 'Сбросить резерв',
                        'class' => 'btn btn-warning'
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
<?php Pjax::end() ?>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
