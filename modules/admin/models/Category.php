<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $name
 * @property string $keywords
 * @property string $description
 */
class Category extends \yii\db\ActiveRecord
{
    
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }
    
    /**
     * Связь для вывода названий категорий вместо id
     * @param type $param
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['name'], 'required'],
            [['name', 'keywords', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ Категории',
            'parent_id' => 'Родительская категория',
            'name' => 'Название категории',
            'keywords' => 'Ключевые слова',
            'description' => 'Описания',
        ];
    }
}
