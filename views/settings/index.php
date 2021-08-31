<?php

/**
 * @var $this \yii\web\View
 * @var $settings \app\models\Settings[]
 */

$this->title = 'Настройки';

?>


<div class="panel panel-inverse news-index">
    <div class="panel-heading">
        <!--        <div class="panel-heading-btn">-->
        <!--        </div>-->
        <h4 class="panel-title">Новости</h4>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <?php if (count($settings) > 0) { ?>
                    <form method="post" class="form-horizontal form-bordered" style="padding: 0;">
                        <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>"
                               value="<?= Yii::$app->request->csrfToken ?>">
                        <?php foreach ($settings as $setting): ?>
                            <div class="form-group">
                                <label for=""
                                       class="control-label col-md-2"><?= Yii::$app->formatter->asRaw($setting->label) ?></label>
                                <div class="col-md-10">
                                    <div class="col-md-8">
                                            <input name="Settings[<?= $setting->key ?>]" type="text"
                                                   value="<?= $setting->value ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="form-group">
                            <label for="" class="control-label col-md-2"></label>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <button type="submit" style="margin-left: 15px;"
                                            class="btn btn-success btn-sm">Сохранить
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php } else { ?>
                    <div class="note note-danger" style="margin: 15px;">
                        <h4><i class="fa fa-exclamation-triangle"></i> Настроек в базе данных не обнаружено!
                        </h4>
                        <p>
                            Убедитесь, что все миграции выполнены без ошибок
                        </p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>