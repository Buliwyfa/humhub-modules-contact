<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$module = Yii::$app->getModule('contact');
?>

<?= (NULL !== $module->settings->get('beforeContactFormRender') ? $module->settings->get('beforeContactFormRender') : '') ?>

<div class="container">
    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
    <div class="row">
        <div class="col-sm-5 col-md-3">
            <?= $form->field($model, 'name')->textInput(['placeholder' => 'name', 'autofocus' => true])->label(false) ?>
            <?= $form->field($model, 'occupation')->textInput(['placeholder' => 'occupation'])->label(false) ?>
            <?= $form->field($model, 'email')->textInput(['placeholder' => 'e-mail address',])->label(false) ?>
        </div>
        <div class="col-sm-5 col-md-3">
            <?= $form->field($model, 'subject')->textInput(['placeholder' => 'subject'])->label(false) ?>
            <?= $form->field($model, 'body')->textarea(['placeholder' => 'message body', 'rows' => 3])->label(false) ?>
        </div>
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            <?= Html::submitButton('Reset', ['class' => 'btn btn-danger', 'name' => 'contact-button']) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<?= NULL !== $module->settings->get('afterContactFormRender') ? $module->settings->get('afterContactFormRender') : '' ?>
