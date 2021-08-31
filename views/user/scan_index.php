<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HistorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $candidateId integer */

CrudAsset::register($this);

?>
<?=GridView::widget([
    'id'=>'crud-sms-datatable',
    'dataProvider' => $dataProvider,
//            'filterModel' => $searchModel,
    'pjax'=>true,
    'columns' => require(__DIR__.'/_scan_columns.php'),
    'panelBeforeTemplate' =>    Html::a('Добавить <i class="fa fa-plus"></i>', ['scan/create', 'user_id' => $user_id, 'containerPjaxReload' => '#crud-sms-datatable-pjax'],
        ['role'=>'modal-remote','title'=> 'Добавить Заказ','class'=>'btn btn-success']),
    'striped' => true,
    'condensed' => true,
    'responsive' => true,
    'panel' => [
        'headingOptions' => ['style' => 'display: none;'],
        'after'=>'',
    ]
])?>