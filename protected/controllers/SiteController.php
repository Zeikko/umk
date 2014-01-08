<?php

class SiteController extends Controller
{

    public function actionIndex()
    {
        $artists = Artist::getArtists();
        $this->render('index', array(
            'artists' => $artists
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
            new CHttpException(404, 'Not Found');
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

}