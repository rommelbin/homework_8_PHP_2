<?php foreach ($orders as $key => $val): ?>
    <div class=""> ID заказа: <?= $val['id'] ?> </div>
    <div class="">Почта: <?= $val['email'] ?></div>
    <div class=""> Номер: <?= $val['num'] ?></div>
    <div class=""> Статус заказа: <?= $val['status'] ?></div>
    <div class=""> Создано: <?= $val['created_at'] ?></div>
    <div class=""> Обновлено: <?= $val['updated_at'] ?></div>
    <br>
    <a href="/Order/About/?session_id=<?=$val['session_id']?>&id=<?=$val['id']?>">Перейти к заказу</a>
    <hr>
<?php endforeach; ?>
