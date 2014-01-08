<script type="text/javascript">
    $(document).ready(function() {

        var tweetTemplate = _.template('<div class="tweet"><div class="tweet-content"><img class="user-image img-rounded" src="<%= profile_image_url %>" /><div><span class="name"><%= name %></span> <span class="screen-name">@<%= screen_name %></span><span class="time"><abbr class="timeago" title="<%= created_at %>"><%= created_at_title %></abbr></span></div><%= text %></div></div>');

        $.ajax({
            dataType: 'json',
            url: '<?php echo Yii::app()->params['tweetCounterUrl'] ?>' + 'groups/toptweets/',
            data: {
                group: '<?php echo $artist['name']; ?>',
                from: '<?php echo date('c', ceil(strtotime('-7 days') / 86400) * 86400); ?>',
                to: '<?php echo date('c', ceil(time() / 86400) * 86400) ?>',
                number: 4,
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
        })
    });
</script>

<div class="artist-single">
    <div class="col-md-6">
        <h2 class="artist-name"><?php echo $artist['name']; ?></h2>
        <img class="img-rounded" src="<?php echo Artist::getImage($artist['name']); ?>" alt="<?php echo $artist['name']; ?>" />
    </div>
    <div class="col-md-6">
        <?php
        $this->widget('TimeseriesChart', array(
            'url' => Yii::app()->params['tweetCounterUrl'] . 'groups/tweetcounts/',
            'serieName' => 'Tweettejä',
            'heading' => 'Tweetit yhteensä:',
            'parameters' => array(
                'group' => $artist['name'],
                'from' => date('c', ceil(strtotime('1.1.2014') / 86400) * 86400),
                'to' => date('c', ceil(time() / 86400) * 86400),
            )
        ));
        ?>
    </div>
    <div class="col-md-6">
        <h2>Viikon tweetit</h2>
        <div id="tweets">

        </div>
    </div>
    <div class="col-md-6">
        <?php
        $this->widget('TimeseriesChart', array(
            'url' => Yii::app()->params['tweetCounterUrl'] . 'groups/tweetcounts/',
            'serieName' => 'Tweettejä',
            'heading' => 'Tweetit yhteensä:',
            'parameters' => array(
                'group' => $artist['name'],
                'from' => date('c', ceil(strtotime('1.1.2014') / 86400) * 86400),
                'to' => date('c', ceil(time() / 86400) * 86400),
            )
        ));
        ?>

    </div>
</div>