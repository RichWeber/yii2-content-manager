<?php

namespace richweber\content\manager\models;

use Yii;
use yii\db\ActiveRecord;
use creocoder\translateable\TranslateableBehavior;
use richweber\content\manager\models\query\ContentQuery;

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
    /**
     * Statuses
     */
    const STATUS_ACTIVE = 1;
    const STATUS_BLOCKED = 2;

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
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_BLOCKED]],
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

    /**
     * @inheritdoc
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_INSERT | self::OP_UPDATE,
        ];
    }

    /**
     * Get current content
     *
     * @return object
     */
    public function getCurrentContent()
    {
        return $this->translate(substr(Yii::$app->language, 0, 2));
    }

    /**
     * Get topic of the content
     *
     * @return string
     */
    public function getName()
    {
        return $this->getCurrentContent()->name;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->getCurrentContent()->content;
    }

    /**
     * Get translations
     *
     * @return \richweber\content\models\ContentTranslation
     */
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
            'id' => Yii::t('content-manager', 'ID'),
            'key' => Yii::t('content-manager', 'Content key'),
            'status' => Yii::t('content-manager', 'Status'),
            'created_at' => Yii::t('content-manager', 'Created'),
            'updated_at' => Yii::t('content-manager', 'Updated'),
            'name' => Yii::t('content-manager', 'Name'),
            'statusName' => Yii::t('content-manager', 'Status'),
        ];
    }

    /**
     * @inheritdoc
     * @return ContentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ContentQuery(get_called_class());
    }

    /**
     * Get status name
     *
     * @return string
     */
    public function getStatusName()
    {
        return self::getAttributeStatus($this->status);
    }

    /**
     * Get status name
     *
     * @param integer $status
     *
     * @return string
     */
    public static function getAttributeStatus($status)
    {
        $array = self::getStatuses();

        if (array_key_exists($status, $array)) {
            return $array[$status];
        } else {
            return null;
        }
    }

    /**
     * Get statuses
     *
     * @return array
     */
    public static function getStatuses()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('content-manager', 'Active'),
            self::STATUS_BLOCKED => Yii::t('content-manager', 'Blocked'),
        ];
    }
}
