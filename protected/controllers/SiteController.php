<?php

class SiteController extends Controller
{

    public function actionIndex()
    {
        $artists = Artist::getArtists();
        $artistNames = array();
        foreach ($artists as $artist) {
            $artistNames[] = $artist['name'];
        }
        $this->render('index', array(
            'artists' => $artists,
            'artistNames' => $artistNames,
        ));
    }

    public function actionArtist($name)
    {
        $name = urldecode($name);
        $artist = Artist::getArtist($name);
        if ($artist) {
            $this->render('artist', array(
                'artist' => $artist,
            ));
        } else {
            throw new CHttpException(404, 'Not Found');
        }
    }

    public function actionArtistEmbed($name)
    {
        $this->layout = 'plain';
        $name = urldecode($name);
        $artist = Artist::getArtist($name);
        if ($artist) {
            $this->render('artistEmbed', array(
                'artist' => $artist,
            ));
        } else {
            throw new CHttpException(404, 'Not Found');
        }
    }

    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    public function actionUmk14()
    {
        $this->render('umk14', array(
        ));
    }

    public function actionUmk14Embed()
    {
        $this->layout = 'plain';
        $this->render('umk14Embed', array(
        ));
    }

    public function actionUmk15Embed()
    {
        $this->layout = 'plain';
        $this->render('umk15Embed', array(
        ));
    }

}