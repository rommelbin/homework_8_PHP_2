<?php foreach ($catalog as $item):?>
    <div>
        <h3><a href="/product/card/?id=<?=$item['id']?>"><?=$item['name']?></a></h3>
        <p>price: <?=$item['price']?></p>
        <button data-id="<?=$item['id']?>" class="buy">Купить</button>
    </div>
<?php endforeach;?>
<a href="/product/catalog/?page=0">1</a>
<a href="/product/catalog/?page=1">2</a>
<a href="/product/catalog/?page=2">3</a>
<a href="/product/catalog/?page=3">4</a>



<script>
    let buttons = document.querySelectorAll('.buy');
    buttons.forEach((elem) => {
        elem.addEventListener('click', () => {
            let id = elem.getAttribute('data-id');
            (
                async () => {
                    const response = await fetch('/basket/add', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json;charset=utf-8'},
                        body: JSON.stringify({
                            id: id
                        })
                    });
                    const answer = await response.json();
                    document.getElementById('count').innerText = answer.count;
                }
            )();
        })
    });
</script>