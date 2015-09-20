<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model richweber\content\manager\models\Content */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('contentManager', 'Contents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('contentManager', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('contentManager', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('contentManager', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'key',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
