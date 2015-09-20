<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model richweber\content\manager\models\Content */

$this->title = Yii::t('contentManager', 'Update {modelClass}: ', [
    'modelClass' => 'Content',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('contentManager', 'Contents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('contentManager', 'Update');
?>
<div class="content-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
