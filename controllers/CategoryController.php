<?php

namespace app\controllers;

use Yii;
use app\controllers\AppController;
use app\models\Category;
use app\models\Product;
use yii\data\Pagination;
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
        
        if(empty($hits))
        {
            throw new \yii\web\HttpException(404, 'Такой категории нет.');
        }
        
        $this->setMetaTags('Главная страница', 'Магазин одежды', 'купить недорого, одежда');
        
        return $this->render('index', compact('hits'));
    }
    
    public function actionView() 
    {
        $id = Yii::$app->request->get('id');
        
        $product = new Product();
        $category = new Category();
        
        $query = $product->getProductsById($id);
        
        $pages = new Pagination([
            'totalCount' => $query->count(), 
            'pageSize' => 3, 
            'forcePageParam' => false,
            'pageSizeParam' => false,
            ]);
        
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        
        
        $categoryTitle = $category->getCategory($id);
        
        if(empty($categoryTitle))
        {
            throw new \yii\web\HttpException(404, 'Такой категории нет.');
        }
        
        $this->setMetaTags($categoryTitle->name, $categoryTitle->keywords, $categoryTitle->description);
        //ninja($products);
        return $this->render('view', compact('products','pages', 'categoryTitle'));
    }
}
