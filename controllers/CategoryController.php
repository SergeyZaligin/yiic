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
    /**
     * Index page
     * @return type
     */
    public function actionIndex()
    {
        $product = new Product();
        
        $hits = $product->getProductHit();
        
        return $this->render('index', compact('hits'));
    }
    
    public function actionView() 
    {
        $id = Yii::$app->request->get('id');
        
        $product = new Product();
        
        $products = $product->getProductById($id);
        
        //ninja($products);
        return $this->render('view', compact('products'));
    }
}
