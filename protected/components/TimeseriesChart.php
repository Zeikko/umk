<?php

class TimeseriesChart extends CWidget
{

    public $id;
    public static $counter = 0;
    public $heading = '';
    public $totalTooltip;
    public $compareTooltip;
    public $chartOptions;

    public function init()
    {
        if ($this->heading) {
            $this->heading .= ' ';
        }
        if (!$this->id) {
            $this->id = 'timeseries-chart-' . self::$counter;
            self::$counter++;
        }
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
                        Yii::getPathOfAlias('webroot.js') . '/moment.min.js'
                )
        );
        Yii::app()->clientScript->registerScriptFile(
                Yii::app()->assetManager->publish(
                        Yii::getPathOfAlias('webroot.protected.components.js') . '/highchartsOptions.js'
                )
        );
        $this->render('timeseriesChart', array(
        ));
    }

}