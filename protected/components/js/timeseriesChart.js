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
                    type: 'datetime',
                    labels: {
                        y: 22
                    }
                }
            ],
            yAxis: [
                {
                    min: 0,
                    max: this.options.max,
                    title: false,
                    gridLineWidth: 2,
                    gridLineColor: '#979797'
                }
            ],
            tooltip: {
                style: {
                    fontSize: '14px'
                }
            },
            legend: false,
            credits: {
                enabled: false
            },
            title: false,
            plotOptions: {
                line: {
                    animation: false,
                    lineWidth: 6,
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