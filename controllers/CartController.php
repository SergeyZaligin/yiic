<?php


namespace app\controllers;

use Yii;
use app\controllers\AppController;
use app\models\Cart;
use app\models\Product;
use app\models\Order;
use app\models\OrderItems;


/**
 * Description of CartController
 *
 * @author cobweb
 */
class CartController extends AppController 
{
    public function actionView() 
    {
        $session = Yii::$app->session;
        
        $session->open();
        
        $this->setMetaTags('Корзина');
        
        $modelOrder = new Order();
        
        if($modelOrder->load(Yii::$app->request->post()))
        {
            $modelOrder->qty = $session['cart.qty'];
            $modelOrder->sum = $session['cart.sum'];
            
            if($modelOrder->save())
            {
                $this->saveOrderItems($session['cart'], $modelOrder->id);
                
                Yii::$app->session->setFlash('success', 'Ваш заказ принят. Наш менеджер скоро свяжеться с Вами.');
                
                Yii::$app->mailer->compose('order', compact('session'))
                        ->setFrom('cplusplusjs@gmail.com')
                        ->setTo($modelOrder->email)
                        ->setSubject('Заказ')
                        ->send();
                
                $session->remove('cart');
        
                $session->remove('cart.qty');
        
                $session->remove('cart.sum');
                
                return Yii::$app->getResponse()->refresh();
            }
            else
            {
                Yii::$app->session->setFlash('error', 'Ошибка заказа.');

            }
            //ninja(Yii::$app->request->post());
        }
        
        return $this->render('view', compact('session', 'modelOrder'));
    }
    
    protected function saveOrderItems($items, $order_id) 
    {
        foreach ($items as $id => $item)
        {
            $modelOrderItems = new OrderItems();
            
            $modelOrderItems->order_id = $order_id;
            $modelOrderItems->product_id = $id;
            $modelOrderItems->name = $item['name'];
            $modelOrderItems->price = $item['price'];
            $modelOrderItems->qty_item = $item['qty'];
            $modelOrderItems->sum_item = $item['qty'] * $item['price'];
            $modelOrderItems->save();
            
        }
    }
    
    public function actionAdd() 
    {
        $id = Yii::$app->request->get('id');
        $qty = (int)Yii::$app->request->get('qty');
        
        $qty = !$qty ? 1 : $qty;
        
        $modelProduct = new Product();
        
        $modelCart = new Cart();
        
        $product = $modelProduct->getProductById($id);
        
        if(empty($product))
        {
            return false;
        }
        
        $session = Yii::$app->session;
        
        $session->open();
        
        $modelCart->addToCart($product, $qty);
        
//        if(!Yii::$app->request->isAjax)
//        {
//            return $this->redirect(Yii::$app->request->referrer);
//        }
//        
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
