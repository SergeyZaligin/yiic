<?php

namespace app\controllers;

use Yii;
use app\controllers\AppController;
use app\models\Category;
use app\models\Product;

/**
 * CategoryController
 *
 * @author cobweb
 */
class CategoryController extends AppController
{
    public function actionIndex()
    {
        $product = new Product();
        
        $hits = $product->getProductHit();
        
        //ninja($n);
        
        return $this->render('index', compact('hits'));
    }
}
