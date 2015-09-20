<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\redactor\widgets\Redactor;

/* @var $this yii\web\View */
/* @var $model richweber\content\manager\models\Content */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="content-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'key')->textInput(['maxlength' => true]) ?>

    <?php
        foreach (Yii::$app->urlManager->languages as $language => $details) {
            echo $form->field($model->translate($language), "[$language]name")->textInput();
            echo $form->field($model->translate($language), "[$language]content")->widget(Redactor::classname());
        }
    ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('contentManager', 'Create') : Yii::t('contentManager', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
