<?php

namespace richweber\content\manager\models;

use Yii;

/**
 * This is the model class for table "{{%cm_content_translation}}".
 *
 * @property integer $content_id
 * @property string $language
 * @property string $name
 * @property string $content
 */
class ContentTranslation extends \yii\db\ActiveRecord
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
            case 'en':
                return [
                    'name' => 'Marker name',
                    'content' => 'Marker name',
                ];
            case 'ru':
                return [
                    'name' => 'Название маркера',
                    'content' => 'Marker name',
                ];
            default:
                return [
                    'name' => 'Назва маркера',
                    'content' => 'Marker name',
                ];
        }
    }

    /**
     * @inheritdoc
     * @return \richweber\content\manager\models\query\ContentTranslationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \richweber\content\manager\models\query\ContentTranslationQuery(get_called_class());
    }
}
