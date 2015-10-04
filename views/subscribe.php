<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\models\ContactForm */
?>
<div class="well">
    <?php $form = ActiveForm::begin(['id' => 'subscribe-form', 'options' => [
            'class' => 'form-horizontal'
         ],
         'fieldConfig' => [
             'template' => '{label}<div class="col-sm-9">{input}</div><div class="col-sm-9 col-sm-offset-3">{error}</div>',
             'labelOptions' => ['class' => 'col-sm-3 control-label'],
         ]]); ?>
        <?= $form->field($model, 'nameFirst') ?>
        <?= $form->field($model, 'nameLast') ?>
        <?= $form->field($model, 'email') ?>
        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
            <?= Html::submitButton('Elküldöm!', ['class' => 'btn btn-success', 'name' => 'contact-button']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
