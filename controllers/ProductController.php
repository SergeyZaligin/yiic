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
        
        $productItem = $product->getProductById($id);
        
        $recommendedProducts = $product->getProductHit();
        
        if(empty($productItem))
        {
            throw new \yii\web\HttpException(404, 'Данного продукта несуществует.');
        }
        
        if(empty($recommendedProducts))
        {
            throw new \yii\web\HttpException(404, 'Данного продукта несуществует.');
        }
        
        $this->setMetaTags($productItem->name, $productItem->keywords, $productItem->description);
        
        //ninja($productItem);
       
        return $this->render('view', compact('productItem', 'recommendedProducts'));
    }

}
