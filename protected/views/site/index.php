<?php
$i = 0;
foreach ($artists as $artist) {
    if ($i % 4 == 0) {
        ?><div class="row"><?php
    }
    ?>
        <div class="artist col-md-3">
            <h2><a href="<?php echo $this->createUrl('site/artist', array('name' => urlencode($artist['name']))) ?>"><?php echo $artist['name']; ?></a></h2>
            <div class="image-wrapper">
                <img class="img-rounded" src="<?php echo Artist::getImage($artist['name']); ?>" alt="<?php echo $artist['name']; ?>" />
            </div>
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
        <?php
        if (($i + 5) % 4 == 0) {
            ?></div><?php
    }
    $i++;
}