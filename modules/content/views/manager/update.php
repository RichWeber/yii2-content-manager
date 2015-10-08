<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model richweber\content\manager\models\Content */

$this->title = Yii::t('content-manager', 'Update: {name}: ', ['name' => $model->name]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('content-manager', 'Content manager'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('content-manager', 'Update');
?>
<div class="content-update">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', ['model' => $model]) ?>

</div>
