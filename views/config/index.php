<?php

use humhub\modules\contactform\Module;
use yii\helpers\ArrayHelper;
use humhub\widgets\Button;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $model \humhub\modules\cfiles\models\ConfigureForm */

$spacesAvailable = yii\helpers\ArrayHelper::map(\humhub\modules\space\models\Space::find()->all(), 'id', 'name');
?>

<div class="panel panel-default">

    <div class="panel-heading">Contact Form Configuration</div>

    <div class="panel-body">
        <?php $form = ActiveForm::begin(['id' => 'configure-form']); ?>
        <?= $form->field($model, 'guestOnly')->checkbox(null, true); ?>
        <?= $form->field($model, 'receipient')->dropDownList($spacesAvailable, ['data-ui-select2' => '']); ?>
        <?= $form->field($model, 'beforeContactFormRender')->textarea(); ?>
        <?= $form->field($model, 'afterContactFormRender')->textarea(); ?>
        <?= Button::save()->submit() ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
