<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use unclead\multipleinput\MultipleInput;

/* @var $this yii\web\View */
/* @var $model app\models\Scan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scan-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'listFile')->widget(MultipleInput::className(), [

                'id' => 'my_id',
                'min' => 1,
                'columns' => [
                    [
                        'name' => 'id',
                        'options' => [
                            'type' => 'hidden'
                        ]
                    ],
                    [
                        'name' => 'name',
                        'title' => 'Название',
                    ],
                    [
                        'name' => 'file_new',
                        'title' => 'Файл',
                        'type'  => 'fileInput',
                        'options' => [
                            'pluginOptions' => [
                                'initialPreview'=>[
                                    //add url here from current attribute
                                ],
                                'showPreview' => false,
                                'showCaption' => true,
                                'showRemove' => true,
                                'showUpload' => false,
                            ]
                        ]
                    ],

                ],
            ])->label(false) ?>
        </div>
    </div>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
