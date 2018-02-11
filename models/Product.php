<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Model of Product
 *
 * @author cobweb
 */
class Product  extends ActiveRecord
{
    /**
     * Name db table
     * @return string
     */
    public static function tableName()
    {
        return 'product';
    }
    
    /**
     * Указываем связь
     * @return type
     */
    public function getCategory() 
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
    
    public function getProductHit() 
    {
        return Product::find()->where(['hit' => '1'])->limit(6)->all();
    }
}
