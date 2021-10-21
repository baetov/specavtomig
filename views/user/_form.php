<?php

use app\models\Role;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use unclead\multipleinput\MultipleInput;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<style>
    #s2-togall-user-user_kind {
        display: none;
    }
</style>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<div class="user-form">
    <div class="modal-teo">

        <div class="row">

            <div class="col-md-3">
               <?= $form->field($model, 'role_id')->dropDownList(ArrayHelper::map(Role::find()->orderBy('name asc')->all(), 'id', 'name')) ?>
            </div>

            <div class="col-md-3">
               <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-md-3">
               <?= $form->field($model, 'birth_date')->input('date') ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <?= $form->field($model, 'login')->textInput() ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'password')->passwordInput() ?>
            </div>
            <div class="col-md-3">
            <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::class, [
                'mask' => '+7 999 999-99-99',
            ]) ?>
            </div>
        </div>




        <?php if (!Yii::$app->request->isAjax){ ?>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        <?php } ?>

    </div>


    <?php ActiveForm::end(); ?>

