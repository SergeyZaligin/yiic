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
        
        $this->setMetaTags('Главная страница', 'Магазин одежды', 'купить недорого, одежда');
        
        return $this->render('index', compact('hits'));
    }
    
    public function actionView() 
    {
        $id = Yii::$app->request->get('id');
        
        $product = new Product();
        $category = new Category();
        
        $products = $product->getProductById($id);
        
        $categoryTitle = $category->getCategory($id);
        
        $this->setMetaTags($categoryTitle->name, $categoryTitle->keywords, $categoryTitle->description);
        //ninja($products);
        return $this->render('view', compact('products', 'categoryTitle'));
    }
}
