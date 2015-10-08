<?php

use richweber\content\manager\models\Content;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\redactor\widgets\Redactor;

/* @var $this yii\web\View */
/* @var $model richweber\content\manager\models\Content */
/* @var $form yii\widgets\ActiveForm */

/* @link http://imperavi.com/redactor/docs/settings/clean/ */
?>

<div class="content-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'key')->textInput(['maxlength' => true]) ?>

    <?php
        foreach (Yii::$app->urlManager->languages as $language => $details) {
            echo $form->field($model->translate($language), "[$language]name")->textInput();
            echo $form->field($model->translate($language), "[$language]content")->widget(Redactor::classname(), [
                'clientOptions' => [
                    'plugins' => ['clips', 'fontcolor','imagemanager', 'fullscreen'],
                    'replaceDivs' => false
                ]
            ]);
        }
    ?>

    <?= $form->field($model, 'status')->dropDownList(Content::getStatuses()) ?>

    <div class="form-group">
        <?= Html::submitButton(
            $model->isNewRecord ? Yii::t('content-manager', 'Create') : Yii::t('content-manager', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
