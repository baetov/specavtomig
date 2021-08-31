<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use app\widgets\BulkButtonWidget;

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
    'columns' => require(__DIR__.'/_columns.php'),

    'striped' => true,
    'condensed' => true,
    'responsive' => true,
//    'panel' => [
//        'headingOptions' => ['style' => 'display: none;'],
//        'after'=>'',
//    ]
])?>