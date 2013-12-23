<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/base';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    public function beforeAction($action)
    {
        Yii::app()->clientScript->registerCssFile(
                Yii::app()->assetManager->publish(
                        Yii::getPathOfAlias('webroot.css') . '/app.css'
                )
        );
        $cs = Yii::app()->clientScript;
        $cs->registerCssFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('webroot.css') . '/bootstrap.css'));
        $cs->registerCssFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('webroot.css') . '/bootstrap-theme.css'));
        $cs->registerScriptFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('webroot.js') . '/bootstrap.js', CClientScript::POS_END));

        return parent::beforeAction($action);
    }

}
