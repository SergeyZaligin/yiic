<?php

namespace app\controllers;

use Yii;
use app\controllers\AppController;
use app\models\Category;
use app\models\Product;

/**
 * ProductController
 *
 * @author cobweb
 */
class ProductController extends AppController
{
    
    public function actionView() 
    {
        $id = Yii::$app->request->get('id');
        
        $product = new Product();
        $category = new Category();
        
        $this->setMetaTags($categoryTitle->name, $categoryTitle->keywords, $categoryTitle->description);
        
        ninja($id);
       
        return $this->render('view', compact('products','pages', 'categoryTitle'));
    }

}
