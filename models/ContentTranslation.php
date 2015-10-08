<?php

namespace richweber\content\manager\models;

use Yii;
use richweber\content\manager\models\query\ContentTranslationQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%cm_content_translation}}".
 *
 * @property integer $content_id
 * @property string $language
 * @property string $name
 * @property string $content
 */
class ContentTranslation extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cm_content_translation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['content_id'], 'integer'],
            [['content'], 'string'],
            [['language'], 'string', 'max' => 16],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        switch ($this->language) {
            case 'uk':
                return [
                    'name' => 'Заголовок',
                    'content' => 'Блок контента',
                ];
            case 'ru':
                return [
                    'name' => 'Тема',
                    'content' => 'Блок контента',
                ];
            default:
                return [
                    'name' => 'Topic',
                    'content' => 'Content',
                ];
        }
    }

    /**
     * @inheritdoc
     * @return ContentTranslationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ContentTranslationQuery(get_called_class());
    }
}
