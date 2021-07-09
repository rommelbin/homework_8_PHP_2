<a href="/">Главная</a>
<a href="/news/show">Новости</a>
<a href="/product/catalog">Каталог продуктов</a>
<a href="/basket/show">Корзина (<span id="count"><?=$count?></span>)</a>
<?php if($isAdmin): ?>
<a href="/order/adminPage">Просмотреть заказы</a>
<?php endif?>
<hr>