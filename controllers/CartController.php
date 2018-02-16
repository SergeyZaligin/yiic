<?php


namespace app\controllers;

use Yii;
use app\controllers\AppController;
use app\models\Cart;
use app\models\Product;

/**
 * Description of CartController
 *
 * @author cobweb
 */
class CartController extends AppController 
{
    public function actionAdd() 
    {
        $id = Yii::$app->request->get('id');
        
        $modelProduct = new Product();
        
        $modelCart = new Cart();
        
        $product = $modelProduct->getProductById($id);
        
        if(empty($product))
        {
            return false;
        }
        
        $session = Yii::$app->session;
        
        $session->open();
        
        $modelCart->addToCart($product);
        
        $this->layout = false;
        
        return $this->render('cart-modal', compact('session'));
        
    }
    
    public function actionClear() 
    {
        $session = Yii::$app->session;
        
        $session->open();
        
        $session->remove('cart');
        
        $session->remove('cart.qty');
        
        $session->remove('cart.sum');
        
        $this->layout = false;
        
        return $this->render('cart-modal', compact('session'));
    }
    
    public function actionDelItem() 
    {
        $id = Yii::$app->request->get('id');
        
        $session = Yii::$app->session;
        
        $session->open();
        
        $modelCart = new Cart();
        
        $modelCart->recalc($id);
        
        $this->layout = false;
        
        return $this->render('cart-modal', compact('session'));
    }
    
    public function actionShow()
    {
        $session = Yii::$app->session;
        
        $session->open();
        
        $this->layout = false;
        
        return $this->render('cart-modal', compact('session'));
    }
    
}
