<?php

use app\models\Client;
use app\models\Technic;
use app\models\TechnicType;
use app\models\Driver;
use app\models\TechnicTypeSubgroup;
use app\models\WorkKind;
use app\models\WorkType;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Bid */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bid-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'client_id')->widget(Select2::classname(), [
                'data' =>  ArrayHelper::map(Client::find()->all(), 'id', 'name'),
                'language' => 'ru',
                'options' => ['placeholder' => 'выберите Контрагента ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'technic_type_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(TechnicType::find()->all(), 'id', 'name'),
                'language' => 'ru',
                'options' => ['placeholder' => 'выберите тип техники...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],'pluginEvents' => [
                    "change:select" => "function() {
                            $.ajax({
                                method: 'GET',
                                url: '/bid/search-kind?q='+$(this).val(),
                                success: function(response){

                                    var data = '';

                                     $.each(response,function(key, value, i){
                                        
                                                data += '<option value=\''+key+'\'>';
                                                    data += value;
                                                data += '</option>';
                                            });
                                    
                                    console.log(data);
                                    
                                }
                            });
                        }",
                    "change" => "function() {
                            $.ajax({
                                method: 'GET',
                                url: '/bid/search-kind?q='+$(this).val(),
                                success: function(response){

                                    var data = '';
                                    
                                    var currentValue = $('#bid-technic_type_id').val();

                                    $.each(response,function(key, value, i){
                                        
                                                data += '<option value=\''+key+'\'>';
                                                    data += value;
                                                data += '</option>';
                                            });
                                    
                                    console.log(data);
                                    
                                    $('#bid-technic_type_subgroup_id').html(data);
                                    
                                    $('#bid-technic_type_subgroup_id').val(currentValue);
                                }
                            });   
                        }",
                ],
            ]);
            ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'technic_type_subgroup_id')->widget(Select2::classname(), [
                'data' =>  ArrayHelper::map(TechnicTypeSubgroup::find()->all(), 'id', 'name'),
                'language' => 'ru',
                'options' => ['placeholder' => 'выберите подгруппу видов техники...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],'pluginEvents' => [
                    "change:select" => "function() {
                            $.ajax({
                                method: 'GET',
                                url: '/bid/search-tech?q='+$(this).val(),
                                success: function(response){

                                    var data = '';

                                     $.each(response,function(key, value, i){
                                        
                                                data += '<option value=\''+key+'\'>';
                                                    data += value;
                                                data += '</option>';
                                            });
                                    
                                    console.log(data);
                                    
                                }
                            });
                        }",
                    "change" => "function() {
                            $.ajax({
                                method: 'GET',
                                url: '/bid/search-tech?q='+$(this).val(),
                                success: function(response){

                                    var data = '';
                                    
                                    var currentValue = $('#bid-technic_type_subgroup_id').val();

                                    $.each(response,function(key, value, i){
                                        
                                                data += '<option value=\''+key+'\'>';
                                                    data += value;
                                                data += '</option>';
                                            });
                                    
                                    console.log(data);
                                    
                                    $('#bid-technic_id').html(data);
                                    
                                    $('#bid-technic_id').val(currentValue);
                                }
                            });   
                        }",
                ],
            ]);
            ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'technic_id')->widget(Select2::classname(), [
                'data' =>  ArrayHelper::map(Technic::find()->all(), 'id', 'name'),
                'language' => 'ru',
                'options' => ['placeholder' => 'выберите технику ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'work_kind_id')->widget(Select2::classname(), [
                'data' =>  ArrayHelper::map(WorkKind::find()->all(), 'id', 'name'),
                'language' => 'ru',
                'options' => ['placeholder' => 'выберите вид работ ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],'pluginEvents' => [
                    "change:select" => "function() {
                            $.ajax({
                                method: 'GET',
                                url: '/bid/search-work?q='+$(this).val(),
                                success: function(response){

                                    var data = '';

                                     $.each(response,function(key, value, i){
                                        
                                                data += '<option value=\''+key+'\'>';
                                                    data += value;
                                                data += '</option>';
                                            });
                                    
                                    console.log(data);
                                    
                                }
                            });
                        }",
                    "change" => "function() {
                            $.ajax({
                                method: 'GET',
                                url: '/bid/search-work?q='+$(this).val(),
                                success: function(response){

                                    var data = '';
                                    
                                    var currentValue = $('#bid-work_kind_id').val();

                                    $.each(response,function(key, value, i){
                                        
                                                data += '<option value=\''+key+'\'>';
                                                    data += value;
                                                data += '</option>';
                                            });
                                    
                                    console.log(data);
                                    
                                    $('#bid-work_type_id').html(data);
                                    
                                    $('#bid-work_type_id').val(currentValue);
                                    
                                }
                            });   
                        }",
                ],
            ]);
            ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'work_type_id')->widget(Select2::classname(), [
                'data' =>  ArrayHelper::map(WorkType::find()->all(), 'id', 'name'),
                'language' => 'ru',
                'options' => ['placeholder' => 'выберите подгруппу видов работ ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class="col-md-3">
        <?= $form->field($model, 'driver_id')->widget(Select2::classname(), [
                'data' =>  ArrayHelper::map(Driver::find()->all(), 'id', 'name'),
                'language' => 'ru',
                'options' => ['placeholder' => 'выберите водителя ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'date')->widget(\kartik\datetime\DateTimePicker::className()) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
        <?= $form->field($model, 'route')->textarea(['rows' => 4]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'status')->dropDownList([
                    0 => 'Резерв',
                    1 => 'Подтверждена',
                    2 => 'В работе',
                    3 => 'Завершена'
            ]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'pay_status')->dropDownList([
                    0 => 'Не оплачено',
                    1 => 'Частично оплачено',
                    2 => 'Оплачено'
            ]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'pay_form')->dropDownList([
                    'Наличный расчет' => 'Наличный расчет',
                    'Б/Н Расчет + НДС' => 'Б/Н Расчет + НДС'
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'price')->textInput() ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'hours')->textInput() ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'mkad')->textInput() ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'mkad_price')->textInput() ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'total')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'garage_out')->widget(\kartik\datetime\DateTimePicker::className()) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'customer_in')->widget(\kartik\datetime\DateTimePicker::className()) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'customer_out')->widget(\kartik\datetime\DateTimePicker::className()) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'garage_in')->widget(\kartik\datetime\DateTimePicker::className()) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'fuel')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
        <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
        </div>
    </div>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
