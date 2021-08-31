<?php

use unclead\multipleinput\MultipleInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\WorkKind */
/* @var $form yii\widgets\ActiveForm */
if($model->isNewRecord == false) {
    $model->workTypes = ArrayHelper::getColumn(\app\models\WorkType::find()->where(['work_kind_id' => $model->id])->all(), 'name');
}
?>

<div class="work-kind-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'workTypes')->widget(MultipleInput::className(), [

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
                'title' => 'Подгруппа видов работ',
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
