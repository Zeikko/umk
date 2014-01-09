;
(function($, window, document, undefined) {

    // Defaults
    var pluginName = "timeseriesChart",
            defaults = {
        series: null,
        max: null
    };

    //Constructor
    function Plugin(element, options) {
        this.element = element;
        this.options = $.extend({}, defaults, options);
        this._defaults = defaults;
        this._name = pluginName;

        this.init();
    }

    Plugin.prototype.init = function() {
        this.renderChart();
    };

    Plugin.prototype.renderChart = function() {
        $(".chart", this.element).highcharts({
            chart: {
                backgroundColor: 'rgba(255, 255, 255, 0)'
            },
            colors: [
                '#40B3D9'
            ],
            xAxis: [
                {
                    type: 'datetime'
                }
            ],
            yAxis: [
                {
                    min: 0,
                    max: this.options.max,
                    title: false

                }
            ],
            legend: false,
            credits: {
                enabled: false
            },
            title: false,
            plotOptions: {
                line: {
                    animation: false,
                    lineWidth: 2.5,
                    marker: {
                        enabled: false
                    }
                }
            },
            'series': this.options.series
        });
    };

    // A really lightweight plugin wrapper around the constructor, 
    // preventing against multiple instantiations
    $.fn[pluginName] = function(options) {
        return this.each(function() {
            if (!$.data(this, "plugin_" + pluginName)) {
                $.data(this, "plugin_" + pluginName,
                        new Plugin(this, options));
            }
        });
    };

})(jQuery, window, document);