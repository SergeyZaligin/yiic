<?php

namespace app\components;

use Yii;
use yii\base\Widget;
use app\models\Category;

/**
 * Widget category menu
 *
 * @author cobweb
 */
class MenuWidget extends Widget
{
    public $tpl;
    public $data;
    public $tree;
    public $menuHTML;
    
    /**
     * Init widget
     */
    public function init() 
    {
        parent::init();
        
        if($this->tpl === null)
        {
            $this->tpl = 'menu';
        }
        
        $this->tpl .= '.php';
    }
    
    /**
     * 
     * @return type
     */
    public function run() 
    {
        
        $menu = Yii::$app->cache->get('menu');
        
        if($menu)
        {
            return $menu;
        }
        
        $this->data = Category::find()->indexBy('id')->asArray()->all();
        
        $this->tree = $this->getTree();
        
        $this->menuHTML = $this->getMenuHtml($this->tree);
        
        Yii::$app->cache->set('menu', $this->menuHTML, 60);
        
        return $this->menuHTML;
    }
    
    /**
     * Build tree category
     * @return type array
     */
    protected function getTree()
    {
        $tree = [];
        
        foreach ($this->data as $id=>&$node) 
        {
            
            if (!$node['parent_id'])
            {
                $tree[$id] = &$node;
            }else
            {
                $this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
            }
            
        }
        return $tree;
    }
    
    protected function getMenuHtml($tree)
    {
        $str = '';
        
        foreach ($tree as $category) 
        {
            $str .= $this->catToTemplate($category);
        }
        
        return $str;
    }

    protected function catToTemplate($category)
    {
        ob_start();
        
        include __DIR__ . '/menu_tpl/' . $this->tpl;
        
        return ob_get_clean();
    }
}