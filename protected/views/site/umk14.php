<script type="text/javascript">
    var loadData = function loadData() {
        var tweetTemplate = _.template('<div class="tweet"><div class="tweet-content"><img class="user-image img-rounded" src="<%= profile_image_url %>" /><div><span class="name"><%= name %></span> <span class="screen-name">@<%= screen_name %></span><span class="time"><abbr class="timeago" title="<%= created_at %>"><%= created_at_title %></abbr></span></div><p><%= text %></p></div></div>');

        $.ajax({
            dataType: 'json',
            url: '<?php echo Yii::app()->params['tweetCounterUrl'] ?>' + 'groups/toptweets/',
            data: {
                group: 'UMK14',
                from: '<?php echo date('c', ceil(strtotime('-7 days') / 86400) * 86400); ?>',
                to: '<?php echo date('c', ceil(time() / 86400) * 86400) ?>',
                number: 5
            },
            success: function(response) {
                var tweetsHtml = '';
                $.each(response.tweets, function(index, tweet) {
                    tweet.created_at_title = moment(tweet.created_at).format('D.M.YYYY HH:mm:ss');
                    tweetsHtml += tweetTemplate(tweet);
                });
                $('#tweets').html(tweetsHtml);
                jQuery("abbr.timeago").timeago();
            }
        });


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
        setInterval(loadData, 1000 * 60);
    });
</script>

<div class="col-md-12">
    <?php
    $this->widget('TimeseriesChart', array(
        'heading' => '#UMK14 Tweetit:',
    ));
    ?>
    <h2>Viikon parhaat tweetit</h2>
    <div id="tweets">

    </div>
</div>