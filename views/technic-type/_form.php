<?php

use unclead\multipleinput\MultipleInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TechnicType */
/* @var $form yii\widgets\ActiveForm */
if($model->isNewRecord == false) {
    $model->subgroups = ArrayHelper::getColumn(\app\models\TechnicTypeSubgroup::find()->where(['technic_type_id' => $model->id])->all(), 'name');
}
?>


<div class="technic-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'subgroups')->widget(MultipleInput::className(), [

        'id' => 'my_id',
        'min' => 0,
        'columns' => [
            [
                'name' => 'id',
                'options' => [
                    'type' => 'hidden'
                ]
            ],
            [
                'name' => 'name',
                'title' => 'Подгруппа видов техники',
            ],


        ],
    ]) ?>



    <?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
