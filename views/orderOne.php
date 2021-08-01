<h2>Изменить статус заказа</h2>
<form action="/Order/ChangeStatus" method="POST">
    <select name="status" id="">
        <option value="check" <?php if($order_status == 'check'): echo 'required'; endif;?>> Проверка</option>
        <option value="way"<?php if($order_status == 'way'): echo 'required'; endif;?> >В пути</option>
        <option value="confirmed" <?php if($order_status == 'confirmed'): echo 'required'; endif;?>> Подтверждено</option>
        <option value="impossible" <?php if($order_status == 'impossible'): echo 'required'; endif;?>>Доставка отменена</option>
    </select>
    <input type="hidden" name="order_id" value="<?=$order_id?>">
    <input type="submit" value="Изменить">
</form>
<?php foreach ($order as $key => $val): ?>
    <h1><?= $val['name'] ?></h1>
    <h3><?= $val['description'] ?></h3>
    <b>price: <?= $val['price'] ?></b>
    <hr>
<?php endforeach; ?>