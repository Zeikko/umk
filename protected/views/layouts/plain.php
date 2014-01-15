<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo CHtml::encode(''); ?></title>
        <?php
        Yii::app()->clientScript->registerCssFile(
                Yii::app()->assetManager->publish(
                        Yii::getPathOfAlias('webroot.css') . '/app.css'
                )
        );
        Yii::app()->clientScript->registerCssFile(
                Yii::app()->assetManager->publish(
                        Yii::getPathOfAlias('webroot.css') . '/embed.css'
                )
        );
        ?>
    </head>
    <body>
        <?php echo $content; ?>
    </body>
</html>