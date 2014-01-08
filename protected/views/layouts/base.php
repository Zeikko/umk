<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo CHtml::encode(''); ?></title>
    </head>
    <body>
        <div class="container">
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
            <?php echo $content; ?>
        </div>
    </body>
</html>