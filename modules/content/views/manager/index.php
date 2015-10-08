<?php

use kartik\daterange\DateRangePicker;
use richweber\content\manager\models\Content;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel richweber\content\manager\models\search\ContentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('content-manager', 'Content manager');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-index">

    <h2><?= Html::encode($this->title) ?></h2>

    <p>
        <?= Html::a(Yii::t('content-manager', 'Add new content block'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
            'firstPageLabel' => true,
            'lastPageLabel' => true,
        ],
        'rowOptions' => function ($model, $key, $index, $grid) {
            return [
                'id' => $model['id'],
                'style' => 'text-align: center;',
            ];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'key',
            'name',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function($data) {
                    if ($data->status === Content::STATUS_BLOCKED) {
                        return Html::tag('span', $data->StatusName, ['class' => 'label label-danger']);
                    }
                    if ($data->status === Content::STATUS_ACTIVE) {
                        return Html::tag('span', $data->StatusName, ['class' => 'label label-success']);
                    }

                    return $data->StatusName;
                },
                'filter' => Content::getStatuses(),
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:d.m.Y H:i:s'],
                'filter' => DateRangePicker::widget([
                    'useWithAddon' => true,
                    'presetDropdown' => true,
                    'hideInput' => true,
                    'model' => $searchModel,
                    'attribute' => 'createdRange',
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'timePicker' => true,
                        'timePickerIncrement' => 1,
                        'format' => 'U',
                        'opens' => 'left',
                    ],
                    'containerTemplate' => '<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i>
                        </span><span class="form-control text-right"><span class="pull-left">
                        <span class="range-value" style="display: none;">{value}</span></span><b class="caret"></b>
                        {input}</span>'
                ]),
                'options' => [
                    'class' => 'col-sm-1',
                ],
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
