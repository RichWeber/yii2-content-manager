<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model richweber\content\manager\models\Content */

$this->title = Yii::t('content-manager', 'Add new content block');
$this->params['breadcrumbs'][] = ['label' => Yii::t('content-manager', 'Content manager'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-create">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', ['model' => $model]) ?>

</div>
