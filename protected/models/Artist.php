<?php

class Artist
{

    public static function getArtists()
    {
        return array(
            array(
                'name' => 'Clarissa',
            ),
            array(
                'name' => 'Dennis Fagerström',
                'image' => 'dennis_fagerstrom.jpg',
            ),
            array(
                'name' => 'Hanna Sky',
            ),
            array(
                'name' => 'Hukka ja Mama',
            ),
            array(
                'name' => 'Jasmin Michaela',
            ),
            array(
                'name' => 'Lili Lambert',
            ),
            array(
                'name' => 'Lauri Mikkola',
            ),
            array(
                'name' => 'MadCraft',
            ),
            array(
                'name' => 'Makea',
            ),
            array(
                'name' => 'MIAU',
            ),
            array(
                'name' => 'Mikko Pohjola',
            ),
            array(
                'name' => 'Softengine',
            ),
        );
    }

    public static function getArtist($name)
    {
        foreach (Artist::getArtists() as $artist) {
            if ($artist['name'] == $name) {
                return $artist;
            }
        }
    }

    public static function getImage($name)
    {
        $artist = Artist::getArtist($name);
        if (!isset($artist['image'])) {
            $artist['image'] = str_replace(' ', '_', strtolower($artist['name']));
        }
        $artist['image'] = Yii::app()->baseUrl . '/images/' . $artist['image'];
        return $artist['image'];
    }

}
