<?php

use app\models\User;
use yii\widgets\ActiveForm;

/**
 * @var $model User
 */


$this->title = 'Профиль';

?>

    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4 class="panel-title">Настройки</h4>
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin() ?>

            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($model, 'name')->textInput() ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'login')->textInput() ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'password')->passwordInput() ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($model, 'phone')->textInput() ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <?= \yii\helpers\Html::submitButton('<i class="fa fa-check"></i> Сохранить', ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <img class="circle-img" style="height: 250px; width: 250px; border-radius: 100%; object-fit: contain; border: 2px solid #cecece; cursor: pointer;" src="/<?=$model->getRealAvatar()?>" data-role="profile-image-select">
                        </div>
                    </div>
                </div>
            </div>

            <?php ActiveForm::end() ?>
        </div>
    </div>

<?php

$script = <<< JS
    $('[data-role="profile-image-select"]').click(function(){
        $('#avatar-form input').trigger('click');
    });

    $('#avatar-form input').change(function(){
        $('#avatar-form').submit();
    });
    
    $('#avatar-form').submit(function(e){
        var formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: $('#avatar-form').attr('action'),
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function(response){
                if(response.success === 1){
                    var path = '/'+response.path;
                    $('[data-role="avatar-view"]').each(function(i){
                        $(this).attr('src', path);
                    });
                    $('[data-role="profile-image-select"]').each(function(i){
                        $(this).attr('src', path);
                    });
                }
            }
        });
        e.preventDefault();
    });
JS;

$this->registerJs($script, \yii\web\View::POS_READY);


?>