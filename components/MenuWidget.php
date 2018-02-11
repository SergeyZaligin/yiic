<?php

namespace app\components;

use yii\base\Widget;

/**
 * Widget category menu
 *
 * @author cobweb
 */
class MenuWidget extends Widget
{
    public $tpl;
    
    public function init() 
    {
        parent::init();
        
        if($this->tpl === null)
        {
            $this->tpl = 'menu';
        }
        
        $this->tpl .= '.php';
    }
    
    public function run() 
    {
        return $this->tpl;
    }
}
