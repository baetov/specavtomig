<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Role */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="role-form">

    <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="row">

            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color:#16508A;">Заявки</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'order_create')->checkbox([
                        ],false) ?>
                    </div>
                    <div class="col-md-12">
                        <?= $form->field($model, 'order_update')->checkbox([

                        ],false) ?>
                    </div>
                    <div class="col-md-12">
                        <?= $form->field($model, 'order_delete')->checkbox([

                        ],false) ?>
                    </div>
                    <div class="col-md-12">
                        <?= $form->field($model, 'order_view')->checkbox([

                        ],false) ?>
                    </div>
                    <div class="col-md-12">
                        <?= $form->field($model, 'order_view_all')->checkbox([

                        ],
                            false) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-md-6">
                <?= $form->field($model, 'directory_access')->checkbox([
                ],false) ?>
        </div>
    </div>

    <?php if (!Yii::$app->request->isAjax){ ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>
</div>
