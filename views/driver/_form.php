<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Driver */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="driver-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([
        1 => 'Водитель тягача',
        2 => 'Водитель автокарна',
        3 => 'Водитель манипулятора'
    ]) ?>

    <?= $form->field($model, 'birth')->input('date') ?>

    <?= $form->field($model, 'passport')->textInput() ?>

    <?= $form->field($model, 'driver_license')->textInput() ?>

    <?= $form->field($model, 'crane_license')->textInput() ?>

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
