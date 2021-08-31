<?php

use app\models\TechnicType;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Technic */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="technic-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gos_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'characteristics')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'equipment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type_id')->widget(Select2::classname(), [
        'data' =>  ArrayHelper::map(TechnicType::find()->all(), 'id', 'name'),
        'language' => 'ru',
        'options' => ['placeholder' => 'выберите вид техники ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],'pluginEvents' => [
            "change:select" => "function() {
                            $.ajax({
                                method: 'GET',
                                url: '/technic/search-kind?q='+$(this).val(),
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
                                url: '/technic/search-kind?q='+$(this).val(),
                                success: function(response){

                                    var data = '';
                                    
                                    var currentValue = $('#technic-type_id').val();

                                    $.each(response,function(key, value, i){
                                        
                                                data += '<option value=\''+key+'\'>';
                                                    data += value;
                                                data += '</option>';
                                            });
                                    
                                    console.log(data);
                                    
                                    $('#technic-subgroup_id').html(data);
                                    
                                    $('#technic-subgroup_id').val(currentValue);
                                }
                            });   
                        }",
        ],
    ]);
    ?>
    <?= $form->field($model, 'subgroup_id')->widget(Select2::classname(), [
        'data' =>  ArrayHelper::map(TechnicType::find()->all(), 'id', 'name'),
        'language' => 'ru',
        'options' => ['placeholder' => 'выберите подгруппу ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
