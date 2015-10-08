<?php

namespace richweber\content\manager\models\query;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\richweber\content\manager\models\ContentTranslation]].
 *
 * @see \richweber\content\manager\models\ContentTranslation
 */
class ContentTranslationQuery extends ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \richweber\content\manager\models\ContentTranslation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \richweber\content\manager\models\ContentTranslation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
