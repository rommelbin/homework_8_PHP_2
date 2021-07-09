<?php if (!empty($basket)): ?>
    <?php foreach ($basket as $item): ?>
        <div id="<?= $item['basket_id'] ?>">
            <h2><?= $item['name'] ?></h2>
            <p>Описание: <?= $item['description'] ?></p>
            <p>Цена:<?= $item['price'] ?></p>

            <button data-id="<?= $item['basket_id'] ?>" class="delete">Удалить</button>
        </div>
    <? endforeach; ?>
    <form action="/order/make" method="post">
        <br>
        <input type="text" name="num" placeholder="Ваш номер телефона" required>
        <br>
        <br>
        <input type="text" name='email' placeholder="Ваша электронная почта" required>
        <br>
        <br>
        Оформить заказ
        <input type="submit">
    </form>
<?php else: ?>
    Корзина пуста
<?php endif; ?>
<script>
    let buttons = document.querySelectorAll('.delete');
    buttons.forEach((elem) => {
        elem.addEventListener('click', () => {
            let id = elem.getAttribute('data-id');
            (
                async () => {
                    const response = await fetch('/basket/delete', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json;charset=utf-8'},
                        body: JSON.stringify({
                            id: id
                        })
                    });
                    const answer = await response.json();
                    document.getElementById('count').innerText = answer.count;
                    document.getElementById(id).remove();
                }
            )();
        })
    });
</script>
