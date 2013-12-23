<?php

class TimeseriesChart extends CWidget
{

    public $id;
    public static $counter = 0;
    public $url;
    public $parameters = array();
    public $serieName;

    public function init()
    {
        $this->id = 'timeseries-chart-' . self::$counter;
        self::$counter++;
    }

    public function run()
    {
        Yii::app()->clientScript->registerCoreScript('jquery');
        Yii::app()->clientScript->registerScriptFile(
                Yii::app()->assetManager->publish(
                        Yii::getPathOfAlias('webroot.protected.components.highcharts') . '/highcharts.js'
                )
        );
        Yii::app()->clientScript->registerScriptFile(
                Yii::app()->assetManager->publish(
                        Yii::getPathOfAlias('webroot.protected.components.highcharts') . '/highcharts-more.js'
                )
        );
        Yii::app()->clientScript->registerScriptFile(
                Yii::app()->assetManager->publish(
                        Yii::getPathOfAlias('webroot.protected.components.js') . '/timeseriesChart.js'
                )
        );
        Yii::app()->clientScript->registerScriptFile(
                Yii::app()->assetManager->publish(
                        Yii::getPathOfAlias('webroot.protected.components.js') . '/moment.min.js'
                )
        );
        Yii::app()->clientScript->registerScriptFile(
                Yii::app()->assetManager->publish(
                        Yii::getPathOfAlias('webroot.protected.components.js') . '/highchartsOptions.js'
                )
        );
        Yii::app()->clientScript->registerScript('TimeseriesChart' . $this->id, '
            $("#' . $this->id . '").timeseriesChart({
              url: "' . $this->url . '",
              serieName: "' . $this->serieName . '",
              parameters: ' . json_encode($this->parameters, true) . '
            });
            ', CClientScript::POS_LOAD);
        $this->render('timeseriesChart', array(
        ));
    }

}