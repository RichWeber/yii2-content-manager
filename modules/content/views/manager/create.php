<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model richweber\content\manager\models\Content */

$this->title = Yii::t('contentManager', 'Create Content');
$this->params['breadcrumbs'][] = ['label' => Yii::t('contentManager', 'Contents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
