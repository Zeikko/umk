<script type="text/javascript">
    var loadData = function loadData() {
        $.ajax({
            dataType: 'json',
            url: '<?php echo Yii::app()->params['tweetCounterUrl'] . 'groups/tweetcounts/'; ?>',
            data: {
                groups: 'UMK14',
                from: '<?php echo date('c', ceil(strtotime('1.1.2014') / 86400) * 86400); ?>',
                to: '<?php echo date('c', ceil(time() / 86400) * 86400); ?>',
            },
            context: this,
            success: function(response) {
                $.each(response, function(index, group) {
                    $("#timeseries-chart-" + index + " .total").html(group.tweets.total)
                    var series = [
                        {
                            name: 'Tweettejä',
                            data: new Array()
                        }
                    ];
                    $.each(group.tweets.history, function(index, dataPoint) {
                        series[0].data.push(new Array(moment(dataPoint.time).valueOf(), dataPoint.tweet_count));
                    });
                    $("#timeseries-chart-" + index).timeseriesChart({
                        'series': series
                    });
                });
            }
        });
    }

    $(document).ready(function() {
        loadData();
        setInterval(loadData, 1000 * 60 * 10);
    });
</script>

<div>
    <?php
    $this->widget('TimeseriesChart', array(
        'heading' => '#UMK14 Tweetit:',
    ));
    ?>
</div>
