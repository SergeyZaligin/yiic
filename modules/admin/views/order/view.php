<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1>Просмотр заказа № <?= $model->id ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created_at',
            'updated_at',
            'qty',
            'sum',
            [
                'attribute' => 'status',
                'value' => function ($data){
                    return !$data->status ? "<span class='text-danger'>Неактивен</span>" : "<span class='text-success'>Активен</span>" ;
                },
                'format' => 'raw',
            ],
            //'status',
            'name',
            'email:email',
            'phone',
            'address',
        ],
    ]) ?>

    <?php $items = $model->orderItems; ?>
    
    <?php if(!empty($items)) : ?>
    <div class="table-responsive table-hover table-striped">
        <table class="table">
            <thead>
                <tr>
                    <th>Наименование</th>
                    <th>Цена</th>
                    <th>Кол-во шт.</th>
                    <th>Сумма</th>
                    <th><span class="glyphicon glyphicon-remove"></span></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($items as $id => $item) : ?>
                    <tr>
                        <td>
                            <a href="<?= Url::to(['/product/view', 'id' => $id]); ?>"><?= $item['name']; ?></a>
                        </td>
                        <td>
                            <?= $item['price']; ?>
                        </td>
                        <td>
                            <?= $item['qty_item']; ?>
                        </td>
                        <td>
                            <?= $item['sum_item']; ?>
                        </td>
                        <td>
                            <span data-id="<?=$id;?>" class="glyphicon glyphicon-remove text-danger del-item"></span>
                        </td>
                    </tr>
                <?php endforeach; ?>
                    
               
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>
