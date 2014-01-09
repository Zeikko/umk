<script type="text/javascript">
    var loadData = function loadData() {
        $.ajax({
            dataType: 'json',
            url: '<?php echo Yii::app()->params['tweetCounterUrl'] . 'groups/tweetcounts/'; ?>',
            data: {
                groups: '<?php echo implode(',', $artistNames); ?>',
                from: '<?php echo date('c', ceil(strtotime('1.1.2014') / 86400) * 86400); ?>',
                to: '<?php echo date('c', ceil(time() / 86400) * 86400); ?>',
            },
            context: this,
            success: function(response) {
                var max = 0;
                $.each(response, function(index, group) {
                    //Get max y value
                    $.each(group.tweets.history, function(index, dataPoint) {
                        max = Math.max(dataPoint.tweet_count, max);
                    });
                    $("#timeseries-chart-" + index + " .total span").html(group.tweets.total)
                });
                $.each(response, function(index, group) {
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
                        'series': series,
                        'max': max
                    });
                });
                $('#artists .artist').tsort('.total span', {order: 'desc'});
            }
        });
    }

    $(document).ready(function() {
        loadData();
        setInterval(loadData, 1000* 15);
    });
</script>

<div class="col-md-12">
    <h1>Uuden musiikin kilpailun tweettilaskuri</h1>
    <h4>Laskee tweetit joissa mainitaan artistin Twitter-käyttäjätunnus.</h4>
</div>
<div id="artists">
    <?php
    foreach ($artists as $key => $artist) {
        ?>
        <div class="artist col-md-3">
            <h2><a href="<?php echo $this->createUrl('site/artist', array('name' => urlencode($artist['name']))) ?>"><?php echo $artist['name']; ?></a></h2>
            <div class="image-wrapper">
                <a href="<?php echo $this->createUrl('site/artist', array('name' => urlencode($artist['name']))) ?>">
                    <img class="img-rounded" src="<?php echo Artist::getImage($artist['name']); ?>" alt="<?php echo $artist['name']; ?>" />
                </a>
            </div>
            <?php
            $this->widget('TimeseriesChart', array(
                'id' => 'timeseries-chart-' . $key,
            ));
            ?>
        </div>
        <?php
    }
    ?>
</div>