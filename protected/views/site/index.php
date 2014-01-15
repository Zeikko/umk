<script type="text/javascript">
    var loadData = function loadData() {
        var responses = 0;
        var current = [];
        var previous = [];
        $.ajax({
            dataType: 'json',
            url: '<?php echo Yii::app()->params['tweetCounterUrl'] . 'groups/tweetcounts/'; ?>',
            data: {
                groups: '<?php echo implode(',', $artistNames); ?>',
                from: '<?php echo date('c', ceil(strtotime('-7 days') / 86400) * 86400); ?>',
                to: '<?php echo date('c', ceil(time() / 86400) * 86400); ?>'
            },
            context: this,
            success: function(response) {
                var max = 0;
                $.each(response, function(index, group) {
                    //Get max y value
                    $.each(group.tweets.history, function(index, dataPoint) {
                        max = Math.max(dataPoint.tweet_count, max);
                    });
                    $("#timeseries-chart-" + index + " .total").html(group.tweets.total);
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
                    current.push({
                        'group': group.group,
                        'total': group.tweets.total
                    });
                });
                $('#artists .artist').tsort('.total ', {order: 'desc'});
                responses++;

                if (responses === 2) {
                    compare(current, previous);
                }
            }
        });

        $.ajax({
            dataType: 'json',
            url: '<?php echo Yii::app()->params['tweetCounterUrl'] . 'groups/tweetcounts/'; ?>',
            data: {
                groups: '<?php echo implode(',', $artistNames); ?>',
                from: '<?php echo date('c', ceil(strtotime('-14 days') / 86400) * 86400); ?>',
                to: '<?php echo date('c', ceil(strtotime('-7 days') / 86400) * 86400); ?>'
            },
            context: this,
            success: function(response) {
                responses++;
                $.each(response, function(index, group) {
                    previous.push({
                        'group': group.group,
                        'total': group.tweets.total
                    });
                });
                if (responses === 2) {
                    compare(current, previous);
                }
            }
        });
    };

    function compare(current, previous) {
        var percentage = 0;
        $.each(current, function(index, currentOfGroup) {
            $("#timeseries-chart-" + index + " .compare").removeClass('hidden');
            percentage = '';
            if (previous[index].total && currentOfGroup.total) {
                percentage = currentOfGroup.total / previous[index].total;
                percentage = Math.round((percentage - 1) * 100);

                $("#timeseries-chart-" + index + " .compare").removeClass('positive');
                $("#timeseries-chart-" + index + " .compare").removeClass('negative');
                if (percentage > 0) {
                    percentage = '+' + percentage;
                    $("#timeseries-chart-" + index + " .compare").addClass('positive ');
                }
                else if (percentage < 0) {
                    $("#timeseries-chart-" + index + " .compare").addClass('negative');
                }
                $("#timeseries-chart-" + index + " .compare").html(percentage + ' %');
            }
            else {
                $("#timeseries-chart-" + index + " .compare").html('-');
            }

        });
    }

    $(document).ready(function() {
        jQuery('body').tooltip({"selector": "[data-toggle=tooltip]"});
        loadData();
        setInterval(loadData, 1000 * 60);
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
                'totalTooltip' => 'Tweettien määrä viimeiseltä seitsemältä päivältä.',
                'compareTooltip' => 'Tweettien määrän muutos viimeiseltä seitsemältä päivältä verrattuna edeltävään seitsemään päivään.',
            ));
            ?>
        </div>
        <?php
    }
    ?>
</div>