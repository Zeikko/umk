<?php

$this->widget('TimeseriesChart', array(
    'url' => Yii::app()->params['tweetCounterUrl'] . 'groups/tweetcounts/',
    'serieName' => 'Tweettejä',
    'heading' => '#UMK14 Tweetit:',
    'parameters' => array(
        'group' => 'UMK14',
        'from' => date('c', ceil(strtotime('1.1.2014') / 86400) * 86400),
        'to' => date('c', ceil(time() / 86400) * 86400),
    )
));
?>