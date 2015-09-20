<?php

namespace richweber\content\manager\models;

use creocoder\translateable\TranslateableBehavior;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%cm_content}}".
 *
 * @property integer $id
 * @property string $key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Content extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DEACTIVED = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cm_content}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['key'], 'string', 'max' => 255],
            [['key'], 'unique'],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DEACTIVED]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
            'translateable' => [
                'class' => TranslateableBehavior::className(),
                'translationAttributes' => ['name', 'content'],
            ],
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_INSERT | self::OP_UPDATE,
        ];
    }

    public function getCurrentContent()
    {
        return $this->translate(substr(Yii::$app->language, 0, 2));
    }

    public function getName()
    {
        return $this->getCurrentContent()->name;
    }

    public function getContent()
    {
        return $this->getCurrentContent()->content;
    }

    public function getTranslations()
    {
        return $this->hasMany(ContentTranslation::className(), ['content_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models', 'ID'),
            'key' => Yii::t('models', 'Content key'),
            'status' => Yii::t('models', 'Status'),
            'created_at' => Yii::t('models', 'Created'),
            'updated_at' => Yii::t('models', 'Updated'),
        ];
    }

    /**
     * @inheritdoc
     * @return \richweber\content\manager\models\query\ContentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \richweber\content\manager\models\query\ContentQuery(get_called_class());
    }
}
