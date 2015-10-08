<?php

namespace richweber\content\manager\modules\content;

use yii\filters\AccessControl;

/**
 * Module of the package
 */
class Module extends \yii\base\Module
{
    /**
     * @var boolean Check access to the module
     */
    public $checkAccess = false;

    /**
     * @var string Access role
     */
    public $accessRole = '@';

    /**
     * @var string Controller namespace
     */
    public $controllerNamespace = 'richweber\content\manager\modules\content\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        if ($this->checkAccess) {
            return [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => [$this->accessRole],
                        ],
                    ],
                ],
            ];
        } else {
            return parent::getBehaviors();
        }
    }
}
