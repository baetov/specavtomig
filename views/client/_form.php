<?php

use unclead\multipleinput\MultipleInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ClientContact;
/* @var $this yii\web\View */
/* @var $model app\models\Client */
/* @var $form yii\widgets\ActiveForm */
if($model->isNewRecord == false) {
    $model->contacts = ClientContact::find()->where(['client_id' => $model->id])->all();
}
?>

<div class="client-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills nav-justified">
                <li class="active"><a data-toggle="tab" href="#tab-base">Реквизиты</a></li>
                <li><a data-toggle="tab" href="#tab-bank">Банковские реквизиты</a></li>
            </ul>
        </div>
    </div>

    <div class="tab-content">
        <div id="tab-base" class="tab-pane fade in active">
            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'official_address')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'post_index')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'address_equals')->checkbox() ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'director')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'inn')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'ogrn')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'kpp')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'site')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'contacts')->widget(MultipleInput::className(), [

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
                                'enableError' => true,
                                'title' => 'Имя',
                            ],
                            [
                                'name' => 'position',
                                'title' => 'Должность',
                            ],
                            [
                                'name' => 'phone',
                                'title' => 'Телефон',
                            ],
                            [
                                'name' => 'email',
                                'title' => 'email',
                            ],

                        ],
                    ]) ?>
                </div>
            </div>
        </div>
        <div id="tab-bank" class="tab-pane fade in">
            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'bank_name')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'bank_bik')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'bank_address')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'bank_correspondent_account')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'bank_register_number')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'bank_registration_date')->input('date') ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'bank_payment_account')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div>
    </div>


    <?php if (!Yii::$app->request->isAjax){ ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>


</div>
