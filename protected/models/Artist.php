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
                'image' => 'dennis_fagerstrom',
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
            array(
                'name' => 'Otto Ivar',
            ),
            array(
                'name' => 'Pihka ja myrsky',
            ),
            array(
                'name' => 'Ida Bois',
            ),
            array(
                'name' => 'Heidi Pakarinen',
            ),
            array(
                'name' => 'Eeverest',
            ),
            array(
                'name' => 'Opera Skaala',
            ),
            array(
                'name' => 'Hans On The Bass',
            ),
            array(
                'name' => 'Shava',
            ),
            array(
                'name' => 'Satin Circus',
            ),
            array(
                'name' => 'Jouni Aslak',
            ),
            array(
                'name' => 'Järjestyshäiriö',
            ),
            array(
                'name' => 'Siru',
            ),
            array(
                'name' => 'Aikuinen',
            ),
            array(
                'name' => 'Vilikaspar Kanth',
            ),
            array(
                'name' => 'Norlan El Misionario',
            ),
            array(
                'name' => 'Angelo De Nile',
            ),
            array(
                'name' => 'Solju',
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
        return $artist['image'] . '.png';
    }

}
