<?php
    use yii\helpers\Html;
?>

<?php if(!empty($session['cart'])) : ?>
    <div class="table-responsive table-hover table-striped">
        <table class="table">
            <thead>
                <tr>
                    <th>Фото</th>
                    <th>Наименование</th>
                    <th>Цена</th>
                    <th>Кол-во шт.</th>
                    <th><span class="glyphicon glyphicon-remove"></span></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($session['cart'] as $id => $item) : ?>
                    <tr>
                        <td>
                            <?=Html::img('@web/images/products/' . $item['img'], [
                                'alt' => $item['name'],
                                'width' => '100px'
                                ]);?>
                        </td>
                        <td>
                            <?= $item['name']; ?>
                        </td>
                        <td>
                            <?= $item['price']; ?>
                        </td>
                        <td>
                            <?= $item['qty']; ?>
                        </td>
                        <td>
                            <span data-id="<?=$id;?>" class="glyphicon glyphicon-remove text-danger del-item"></span>
                        </td>
                    </tr>
                <?php endforeach; ?>
                    
                <tfoot>
                    <tr>
                        <td colspan="4">
                            Итого: 
                        </td>
                        <td>
                            <?= $session['cart.qty']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            На сумму: 
                        </td>
                        <td>
                            <?= $session['cart.sum']; ?>
                        </td>
                    </tr>
                </tfoot>
            
            </tbody>
        </table>
    </div>
<?php else : ?>
    <h3>Корзина пуста...</h3>
<?php endif; ?>

