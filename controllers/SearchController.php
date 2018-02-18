<?php

namespace app\controllers;

use Yii;
use app\controllers\AppController;
use app\models\Category;
use app\models\Product;
use yii\data\Pagination;

/**
 * Description of SearchController
 *
 * @author cobweb
 */
class SearchController extends AppController
{
    public function actionSearch()
    {
        $q = trim(Yii::$app->request->get('q'));
        
        if(!$q)
        {
            return $this->render('search');
        }
        
        $product = new Product();
        $category = new Category();
        
        $query = $product->getProductsBySql($q);
        
        $pages = new Pagination([
            'totalCount' => $query->count(), 
            'pageSize' => 3, 
            'forcePageParam' => false,
            'pageSizeParam' => false,
            ]);
        
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        
        $this->setMetaTags($q);
        
        return $this->render('search', compact('products', 'pages', 'q'));
    }
}
