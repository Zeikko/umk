<script type="text/javascript">
    var loadData = function loadData() {
        $.ajax({
            dataType: 'json',
            url: '<?php echo Yii::app()->params['tweetCounterUrl'] . 'groups/tweetcounts/'; ?>',
            data: {
                groups: '<?php echo $artist['name'] ?>',
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

<div class="artist-single">
    <p>Tweetit joissa mainitaan artistin Twitter-käyttäjätunnus</p>
    <?php
    $this->widget('TimeseriesChart', array(
        'heading' => 'Tweetit yhteensä:',
    ));
    ?>
    <p>Löydät lisää reaaliaikaisia Twitter-tilastoja osoitteesta <a target="_blank" href="http://data.yle.fi/umk">data.yle.fi/umk</a>.</p>
</div>