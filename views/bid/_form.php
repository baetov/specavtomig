<?php

use app\models\Client;
use app\models\Technic;
use app\models\TechnicType;
use app\models\Driver;
use app\models\TechnicTypeSubgroup;
use app\models\WorkKind;
//use app\models\WorkType;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Bid */
/* @var $form yii\widgets\ActiveForm */
$priceSum = <<<JS
            let hours = document.getElementById("bid-hours").value;
            let hoursPrice = $(this).val();
            let mkadMileage = document.getElementById("bid-mkad").value;
            let mkadPrice = document.getElementById("bid-mkad_price").value;
            let total = (+hours*+hoursPrice) + (+mkadPrice*+mkadMileage);
            
            if (document.getElementById("nds").value == "+ НДС"){
                total = total*1.2;
            }
            document.getElementById("bid-total").value = total;
JS;
$mkadSum = <<<JS
            let hours = document.getElementById("bid-hours").value;
            let hoursPrice = document.getElementById("bid-price").value;
            let mkadMileage = document.getElementById("bid-mkad").value;
            let mkadPrice = $(this).val();
            let total = (+hours*+hoursPrice) + (+mkadPrice*+mkadMileage);
             if (document.getElementById("nds").value == "+ НДС"){
                total = total*1.2;
            }
            document.getElementById("bid-total").value = total;
JS;
$mkad = <<<JS
            let hours = document.getElementById("bid-hours").value;
            let hoursPrice = document.getElementById("bid-price").value;
            let mkadMileage = $(this).val();
            let mkadPrice = document.getElementById("bid-mkad_price").value;
            let total = (+hours*+hoursPrice) + (+mkadPrice*+mkadMileage);
             if (document.getElementById("nds").value == "+ НДС"){
                total = total*1.2;
            }
            document.getElementById("bid-total").value = total;   
JS;
$hours = <<<JS
            let hours = $(this).val();
            let hoursPrice = document.getElementById("bid-price").value;
            let mkadMileage = document.getElementById("bid-mkad").value;
            let mkadPrice = document.getElementById("bid-mkad_price").value;
            let total = (+hours*+hoursPrice) + (+mkadPrice*+mkadMileage);
             if (document.getElementById("nds").value == "+ НДС"){
                total = total*1.2;
            }
            document.getElementById("bid-total").value = total;
JS;
$hours = <<<JS
            let hours = $(this).val();
            let hoursPrice = document.getElementById("bid-price").value;
            let mkadMileage = document.getElementById("bid-mkad").value;
            let mkadPrice = document.getElementById("bid-mkad_price").value;
            let total = (+hours*+hoursPrice) + (+mkadPrice*+mkadMileage);
             if (document.getElementById("nds").value == "+ НДС"){
                total = total*1.2;
            }
            document.getElementById("bid-total").value = total;
JS;
$nds = <<<JS
        let ndsVal = $(this).val();
        if (ndsVal == "+ НДС"){
            let totalVal = document.getElementById("bid-total").value;
            let total = +totalVal*1.2 ;
            document.getElementById("bid-total").value = total;
        }
        if (ndsVal == "в.ч. НДС"){
            let hours = document.getElementById("bid-hours").value;
            let hoursPrice = document.getElementById("bid-price").value;
            let mkadMileage = document.getElementById("bid-mkad").value;
            let mkadPrice = document.getElementById("bid-mkad_price").value;
            let total = (+hours*+hoursPrice) + (+mkadPrice*+mkadMileage);
            document.getElementById("bid-total").value = total;
        }
JS;

$k_priceSum = <<<JS
            let hours = document.getElementById("bid-k_hours").value;
            let hoursPrice = $(this).val();
            let mkadMileage = document.getElementById("bid-k_mkad").value;
            let mkadPrice = document.getElementById("bid-k_mkad_price").value;
            let total = (+hours*+hoursPrice) + (+mkadPrice*+mkadMileage);
            
            if (document.getElementById("k_nds").value == "+ НДС"){
                total = total*1.2;
            }
            document.getElementById("bid-k_total").value = total;
JS;
$k_mkadSum = <<<JS
            let hours = document.getElementById("bid-k_hours").value;
            let hoursPrice = document.getElementById("bid-k_price").value;
            let mkadMileage = document.getElementById("bid-k_mkad").value;
            let mkadPrice = $(this).val();
            let total = (+hours*+hoursPrice) + (+mkadPrice*+mkadMileage);
             if (document.getElementById("k_nds").value == "+ НДС"){
                total = total*1.2;
            }
            document.getElementById("bid-k_total").value = total;
JS;
$k_mkad = <<<JS
            let hours = document.getElementById("bid-k_hours").value;
            let hoursPrice = document.getElementById("bid-k_price").value;
            let mkadMileage = $(this).val();
            let mkadPrice = document.getElementById("bid-k_mkad_price").value;
            let total = (+hours*+hoursPrice) + (+mkadPrice*+mkadMileage);
             if (document.getElementById("k_nds").value == "+ НДС"){
                total = total*1.2;
            }
            document.getElementById("bid-k_total").value = total;   
JS;
$k_hours = <<<JS
            let hours = $(this).val();
            let hoursPrice = document.getElementById("bid-k_price").value;
            let mkadMileage = document.getElementById("bid-k_mkad").value;
            let mkadPrice = document.getElementById("bid-k_mkad_price").value;
            let total = (+hours*+hoursPrice) + (+mkadPrice*+mkadMileage);
             if (document.getElementById("k_nds").value == "+ НДС"){
                total = total*1.2;
            }
            document.getElementById("bid-k_total").value = total;
JS;
$k_hours = <<<JS
            let hours = $(this).val();
            let hoursPrice = document.getElementById("bid-k_price").value;
            let mkadMileage = document.getElementById("bid-k_mkad").value;
            let mkadPrice = document.getElementById("bid-k_mkad_price").value;
            let total = (+hours*+hoursPrice) + (+mkadPrice*+mkadMileage);
             if (document.getElementById("k_nds").value == "+ НДС"){
                total = total*1.2;
            }
            document.getElementById("bid-k_total").value = total;
JS;
$k_nds = <<<JS
        let ndsVal = $(this).val();
        if (ndsVal == "+ НДС"){
            let totalVal = document.getElementById("bid-k_total").value;
            let total = +totalVal*1.2 ;
            document.getElementById("bid-k_total").value = total;
        }
        if (ndsVal == "в.ч. НДС"){
            let hours = document.getElementById("bid-k_hours").value;
            let hoursPrice = document.getElementById("bid-k_price").value;
            let mkadMileage = document.getElementById("bid-k_mkad").value;
            let mkadPrice = document.getElementById("bid-k_mkad_price").value;
            let total = (+hours*+hoursPrice) + (+mkadPrice*+mkadMileage);
            document.getElementById("bid-k_total").value = total;
        }
JS;
?>

<div class="bid-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'date')->input('date') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'client_id')->widget(Select2::classname(), [
                'data' =>  ArrayHelper::map(Client::find()->all(), 'id', 'name'),
                'language' => 'ru',
                'options' => ['placeholder' => 'выберите Контрагента ...'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'technic_type_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(TechnicType::find()->all(), 'id', 'name'),
                'language' => 'ru',
                'options' => ['placeholder' => 'выберите тип техники...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],'pluginEvents' => [
                    "change:select" => "function() {
                            $.ajax({
                                method: 'GET',
                                url: '/bid/search-kind?q='+$(this).val(),
                                success: function(response){

                                    var data = '';

                                     $.each(response,function(key, value, i){
                                        
                                                data += '<option value=\''+key+'\'>';
                                                    data += value;
                                                data += '</option>';
                                            });
                                    
                                    console.log(data);
                                    
                                }
                            });
                        }",
                    "change" => "function() {
                            $.ajax({
                                method: 'GET',
                                url: '/bid/search-kind?q='+$(this).val(),
                                success: function(response){

                                    var data = '';
                                    
                                    var currentValue = $('#bid-technic_type_id').val();

                                    $.each(response,function(key, value, i){
                                        
                                                data += '<option value=\''+key+'\'>';
                                                    data += value;
                                                data += '</option>';
                                            });
                                    
                                    console.log(data);
                                    
                                    $('#bid-technic_type_subgroup_id').html(data);
                                    
                                    $('#bid-technic_type_subgroup_id').val(currentValue);
                                }
                            });   
                        }",
                ],
            ]);
            ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'technic_type_subgroup_id')->widget(Select2::classname(), [
                'data' =>  ArrayHelper::map(TechnicTypeSubgroup::find()->all(), 'id', 'name'),
                'language' => 'ru',
                'options' => ['placeholder' => 'выберите подтип техники...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],'pluginEvents' => [
                    "change:select" => "function() {
                            $.ajax({
                                method: 'GET',
                                url: '/bid/search-tech?q='+$(this).val(),
                                success: function(response){

                                    var data = '';

                                     $.each(response,function(key, value, i){
                                        
                                                data += '<option value=\''+key+'\'>';
                                                    data += value;
                                                data += '</option>';
                                            });
                                    
                                    console.log(data);
                                    
                                }
                            });
                        }",
                    "change" => "function() {
                            $.ajax({
                                method: 'GET',
                                url: '/bid/search-tech?q='+$(this).val(),
                                success: function(response){

                                    var data = '';
                                    
                                    var currentValue = $('#bid-technic_type_subgroup_id').val();

                                    $.each(response,function(key, value, i){
                                        
                                                data += '<option value=\''+key+'\'>';
                                                    data += value;
                                                data += '</option>';
                                            });
                                    
                                    console.log(data);
                                    
                                    $('#bid-technic_id').html(data);
                                    
                                    $('#bid-technic_id').val(currentValue);
                                }
                            });   
                        }",
                ],
            ]);
            ?>
        </div>

    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'technic_id')->widget(Select2::classname(), [
                'data' =>  ArrayHelper::map(Technic::find()->all(), 'id', 'name'),
                'language' => 'ru',
                'options' => ['placeholder' => 'выберите технику ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'driver_id')->widget(Select2::classname(), [
                'data' =>  ArrayHelper::map(Driver::find()->all(), 'id', 'name'),
                'language' => 'ru',
                'options' => ['placeholder' => 'выберите водителя ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'fuel')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'garage_out')->widget(\kartik\time\TimePicker::className(),[
                'pluginOptions' => [
                    'showSeconds' => false,
                    'showMeridian' => false,
                    'minuteStep' => 1,
                    'defaultTime' => false
                ]
            ])?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'customer_in')->widget(\kartik\time\TimePicker::className(),[
                'pluginOptions' => [
                    'showSeconds' => false,
                    'showMeridian' => false,
                    'minuteStep' => 1,
                    'defaultTime' => false
                ]
            ])?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'customer_out')->widget(\kartik\time\TimePicker::className(),[
                'pluginOptions' => [
                    'showSeconds' => false,
                    'showMeridian' => false,
                    'minuteStep' => 1,
                    'defaultTime' => false
                ]
            ])?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'garage_in')->widget(\kartik\time\TimePicker::className(),[
                'pluginOptions' => [
                    'showSeconds' => false,
                    'showMeridian' => false,
                    'minuteStep' => 1,
                    'defaultTime' => false
                ]
            ])?>
        </div>

    </div>
    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'hours')->textInput(['onchange' => $hours]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'price')->textInput(['onchange' => $priceSum]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'mkad')->textInput(['onchange' => $mkad]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'mkad_price')->textInput(['onchange' => $mkadSum]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'pay_form')->dropDownList([
                'в.ч. НДС' => 'в.ч. НДС',
                '+ НДС' => '+ НДС',
            ],['id' => 'nds','onchange' => $nds]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'total')->textInput() ?>
        </div>
    </div>
    <div class="panel"style="background-color:#f3f8db;color:black;">
        <div class="panel-heading">
            <h4 class="panel-title">Заполнять только в случае если техника контрагента</h4>
            <div class="panel-heading-btn" style="margin-top:-20px;overflow-y: auto;">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-primary"  data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            </div>
        </div>
        <div class="panel-body" style="display: none;">
            <div class="row"style="border: 1px solid orange;padding-top:10px;margin-bottom:10px;">
                <div class="col-md-2">
                    <?= $form->field($model, 'k_hours')->textInput(['onchange' => $k_hours]) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'k_price')->textInput(['onchange' => $k_priceSum]) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'k_mkad')->textInput(['onchange' => $k_mkad]) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'k_mkad_price')->textInput(['onchange' => $k_mkadSum]) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'k_pay_form')->dropDownList([
                        'в.ч. НДС' => 'в.ч. НДС',
                        '+ НДС' => '+ НДС',
                    ],['id' => 'k_nds','onchange' => $k_nds]) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'k_total')->textInput() ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        <?= $form->field($model, 'route')->textarea(['rows' => 4]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'details')->textarea(['rows' => 4]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-10">
                    <?= $form->field($model, 'work_kind_id')->widget(Select2::classname(), [
                        'data' =>  ArrayHelper::map(WorkKind::find()->all(), 'id', 'name'),
                        'language' => 'ru',
                        'options' => ['placeholder' => 'выберите  вид работ ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>
                <div class="col-md-1">
                    <?= Html::a("<i class='fa fa-plus'></i>", ['bid/create-workkind'], [
                        'class' => 'btn btn-default btn-block',
                        'style' => 'margin-top: 22px;',
                        'role' => 'modal-remote',
                        'onclick' => '
                        
                                    var $form = $("#frm");
                                    $.ajax({
                                      type: "POST",
                                      url: "bid/session-form",
                                      data: $form.serialize(),
                                    }).done(function() {
                                      console.log(\'success\');
                                    }).fail(function() {
                                      console.log(\'fail\');
                                    });
                        ',
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
        <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
        </div>
    </div>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
