;
(function($, window, document, undefined) {

    // Defaults
    var pluginName = "timeseriesChart",
            defaults = {
        url: null,
        parameters: null,
        serieName: null
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
        this.loadData();
    };

    Plugin.prototype.loadData = function() {
        $.ajax({
            dataType: 'json',
            url: this.options.url,
            data: this.options.parameters,
            context: this,
            success: function(response) {
                var series = [
                    {
                        name: this.options.serieName,
                        data: new Array(),
                    }
                ];
                $(".total", this.element).html(response.tweets.total);
                $.each(response.tweets.history, function(index, dataPoint) {
                    series[0].data.push(new Array(moment(dataPoint.time).valueOf(), dataPoint.tweet_count));

                });
                this.renderChart(series);
                $('#artists .artist').tsort('.total',{order:'desc'});
            }
        })
    }

    Plugin.prototype.renderChart = function(series) {
        $(".chart", this.element).highcharts({
            chart: {
                backgroundColor: 'rgba(255, 255, 255, 0)'
            },
            xAxis: [
                {
                    type: 'datetime'
                },
            ],
            yAxis: [
                {
                    min: 0,
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
                        enabled: false,
                    }
                }
            },
            'series': series,
        });
    }

    // A really lightweight plugin wrapper around the constructor, 
    // preventing against multiple instantiations
    $.fn[pluginName] = function(options) {
        return this.each(function() {
            if (!$.data(this, "plugin_" + pluginName)) {
                $.data(this, "plugin_" + pluginName,
                        new Plugin(this, options));
            }
        });
    }

})(jQuery, window, document);