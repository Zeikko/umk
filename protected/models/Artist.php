<?php

class Artist
{

    public static function getArtists()
    {
        return array(
            array(
                'name' => 'Clarissa',
                'groupId' => 1,
            ),
            array(
                'name' => 'Dennis Fagerström',
                'image' => 'dennis_fagerstrom.jpg',
                'groupId' => 2,
            ),
            array(
                'name' => 'Hanna Sky',
                'groupId' => 3,
            ),
            array(
                'name' => 'Hukka ja Mama',
                'groupId' => 4,
            ),
            array(
                'name' => 'Jasmin Michaela',
                'groupId' => 5,
            ),
            array(
                'name' => 'Lili Lambert',
                'groupId' => 6,
            ),
            array(
                'name' => 'Lauri Mikkola',
                'groupId' => 7,
            ),
            array(
                'name' => 'MadCraft',
                'groupId' => 8,
            ),
            array(
                'name' => 'Makea',
                'groupId' => 9,
            ),
            array(
                'name' => 'Miau',
                'groupId' => 10,
            ),
            array(
                'name' => 'Mikko Pohjola',
                'groupId' => 11,
            ),
            array(
                'name' => 'Softengine',
                'groupId' => 16,
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
