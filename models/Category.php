<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Model of Category
 *
 * @author cobweb
 */
class Category extends ActiveRecord
{
    /**
     * Name db table
     * @return string
     */
    public static function tableName()
    {
        return 'category';
    }
    
    /**
     * Указываем связь
     * @return type
     */
    public function getProducts() 
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }
    
    public function getCategory($id) 
    {
        return Category::findOne($id);
    }
}
