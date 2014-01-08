<h1>Uuden musiikin kilpailun tweettilaskuri</h1>
<p>Laskee tweetit joissa mainitaan artistin Twitter-käyttäjätunnus.</p>
<div id="artists">
    <?php
    foreach ($artists as $artist) {
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
                'url' => Yii::app()->params['tweetCounterUrl'] . 'groups/tweetcounts/',
                'serieName' => 'Tweettejä',
                'parameters' => array(
                    'group' => $artist['name'],
                    'from' => date('c', ceil(strtotime('26.12.2013') / 86400) * 86400),
                    'to' => date('c', ceil(time() / 86400) * 86400),
                )
            ));
            ?>
        </div>
        <?php
    }
    ?>
</div>