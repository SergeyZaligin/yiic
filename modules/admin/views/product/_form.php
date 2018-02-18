<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\MenuWidget;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
mihaildev\elfinder\Assets::noConflict($this);

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //echo $form->field($model, 'category_id')->textInput() ?>
    
    <div class="form-group field-product-category_id">
    <label class="control-label" for="product-category_id">Родительская категория</label>
    <select id="product-category_id" class="form-control" name="Product[category_id]">
    <?= MenuWidget::widget(['tpl' => 'select-product', 'model' => $model]);?>
    </select>

    <div class="help-block"></div>
    </div>
    

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php
//        echo $form->field($model, 'content')->widget(CKEditor::className(),[
//            'editorOptions' => [
//                'preset' => 'full', // basic
//                'inline' => false, 
//            ],
//        ]);
    
   echo $form->field($model, 'content')->widget(CKEditor::className(), [
  
        'editorOptions' => ElFinder::ckeditorOptions(['elfinder']),
 
    ]);
    ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'img')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hit')->checkbox([ '0' => 'нет', '1' => 'да', ]) ?>

    <?= $form->field($model, 'new')->checkbox([ '0' => 'нет', '1' => 'да', ]) ?>

    <?= $form->field($model, 'sale')->checkbox([ '0' => 'нет', '1' => 'да', ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
