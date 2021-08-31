<?php

use yii\helpers\Html;

/** @var $templates \app\models\Template */
/** @var $claim_id int */

?>

<?php foreach ($templates as $template): ?>

    <?= Html::a($template->name, ['print-template', 'claim_id' => $claim_id, 'template_id' => $template->id], ['class' => 'btn btn-success btn-block', 'target' => '_blank']); ?>

<?php endforeach; ?>
