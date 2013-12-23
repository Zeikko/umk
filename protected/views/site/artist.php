<div class="artist-single">
    <div class="col-md-6">
        <h2><?php echo $artist['name']; ?></h2>
        <img class="img-rounded" src="<?php echo Artist::getImage($artist['name']); ?>" alt="<?php echo $artist['name']; ?>" />
    </div>
    <div class="col-md-6">
        <?php
        $this->widget('TimeseriesChart', array(
            'url' => 'http://localhost/tweettilaskuri/groups/tweets/',
            'serieName' => 'Tweettejä',
            'parameters' => array(
                'group' => $artist['name'],
                'from' => date('c', ceil(strtotime('-7 days') / 86400) * 86400),
                'to' => date('c', ceil(time() / 86400) * 86400),
            )
        ));
        ?>
    </div>
</div>