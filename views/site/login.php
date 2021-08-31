<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Авторизация';

$fieldOptions1 = [
    'options' => ['class' => 'form-group m-b-20'],
    'inputTemplate' => "{input}"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group m-b-20'],
    'inputTemplate' => "{input}"
];
?>
<div class="login bg-black animated fadeInDown">
    <!-- begin brand -->
    <div class="login-header">
        <div class="brand">
            <img src="/img/logo.png" alt="" style="height: 31px;margin-right: auto;margin-left: 70px">
            <small style="margin-left: 55px">Введите данные для авторизации</small>
        </div>
    </div>
    <!-- end brand -->
    <div class="login-content">
        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false], $options = ['class' => 'margin-bottom-0']); ?>
        <?= $form
            ->field($model, 'username', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => 'Логин', 'class' => 'form-control input-lg inverse-mode no-border']) ?>
        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => 'Пароль', 'class' => 'form-control input-lg inverse-mode no-border']) ?>
        <div class="login-buttons">
            <?= Html::submitButton('Войти', ['class' => 'btn btn-primary btn-block btn-lg', 'name' => 'login-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

