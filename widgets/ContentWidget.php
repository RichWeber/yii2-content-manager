<?php

namespace richweber\content\manager\widgets;

use richweber\content\manager\models\Content;
use yii\base\InvalidParamException;
use yii\base\InvalidValueException;
use yii\bootstrap\Widget;

/**
 * Widget returns string of the content by the key
 */
class ContentWidget extends Widget
{
    /**
     * @var string Content key
     */
    public $key;

    /**
     * @inheritdoc
     */
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
