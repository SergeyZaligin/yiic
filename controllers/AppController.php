<?php

namespace app\controllers;

use yii\base\Controller;
/**
 * AppController
 *
 * @author cobweb
 */
class AppController extends Controller
{
    protected function setMetaTags($title = null, $keywords = null, $description = null) 
    {
        $this->view->title = $title;
        $this->view->registerMetaTag([
                'name' => 'keywords',
                'content' => "$keywords",
        ]);
        $this->view->registerMetaTag([
                'name' => 'description',
                'content' => "$description",
        ]);
    }
}
