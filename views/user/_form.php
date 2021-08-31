<?php


use app\models\Role;
use app\models\Crew;
use app\models\Scan;


use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use unclead\multipleinput\MultipleInput;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
if($model->isNewRecord == false) {
    $model->listFile = ArrayHelper::getColumn(Scan::find()->where(['user_id' => $model->id])->all(), 'name');
}
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
            <div class="col-md-3">
                <?= $form->field($model, 'file')->fileInput() ?>
            </div>
        </div>
        <div class="row">
            
        </div>
        <div class="row" id="in" <?php if ($model->type == 0) echo 'hidden'?>>


            <div class="col-md-3">
                <?= $form->field($model, 'inn')->textInput() ?>
            </div>
        </div>
        <div class="row" id="out" <?php if ($model->type == 0 or $model->type == 1) echo 'hidden'?>>
            <div class="col-md-3">
                <?= $form->field($model, 'address')->textInput() ?>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'listFile')->widget(MultipleInput::className(), [

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
                            'title' => 'Название',
                            'enableError' => true,
                        ],
                        [
                            'name' => 'file_new',
                            'title' => 'Файл',
                            'enableError' => true,
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

    </div>


    <?php ActiveForm::end(); ?>

