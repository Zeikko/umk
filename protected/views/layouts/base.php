<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo CHtml::encode(''); ?></title>
        <?php
        Yii::app()->clientScript->registerScriptFile(
                Yii::app()->assetManager->publish(
                        Yii::getPathOfAlias('webroot.js') . '/tinysort.js'
                )
        );
        Yii::app()->clientScript->registerScriptFile(
                Yii::app()->assetManager->publish(
                        Yii::getPathOfAlias('webroot.js') . '/underscore.js'
                )
        );
        Yii::app()->clientScript->registerScriptFile(
                Yii::app()->assetManager->publish(
                        Yii::getPathOfAlias('webroot.js.timeago') . '/timeago.js'
                )
        );
        Yii::app()->clientScript->registerScriptFile(
                Yii::app()->assetManager->publish(
                        Yii::getPathOfAlias('webroot.js.timeago') . '/timeago.fi.js'
                )
        );
        $cs = Yii::app()->clientScript;
        $cs->registerCssFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('webroot.css') . '/bootstrap.css'));
        $cs->registerScriptFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('webroot.js') . '/bootstrap.js', CClientScript::POS_END));
        Yii::app()->clientScript->registerCssFile(
                Yii::app()->assetManager->publish(
                        Yii::getPathOfAlias('webroot.css') . '/app.css'
                )
        );
        ?>
    </head>
    <body>
        <div class="stripe hidden-xs"></div>
        <div class="container">
            <div class="col-md-12">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'htmlOptions' => array(
                        'class' => 'nav nav-pills',
                    ),
                    'items' => array(
                        array('label' => 'Tweetit', 'url' => array('/site/index')),
                        array('label' => '#UMK14', 'url' => array('/site/umk14')),
                    ),
                ));
                ?>
            </div>
            <?php echo $content; ?>
        </div>
    </body>
</html>