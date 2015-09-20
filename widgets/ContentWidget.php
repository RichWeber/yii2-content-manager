<?php

namespace richweber\content\manager\widgets;

use richweber\content\manager\models\Content;
use yii\base\InvalidParamException;
use yii\base\InvalidValueException;

class ContentWidget extends \yii\bootstrap\Widget
{
    public $key;

    public function init()
    {
        parent::init();

        if ($this->key) {
            $model = Content::findOne(['key' => $this->key]);
            if (null !== $model) {
                echo $model->content;
            } else {
                throw new InvalidValueException('Content not found');
            }
        } else {
            throw new InvalidParamException('Invalid content key');
        }
    }
}
