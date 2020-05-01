<section class="cart-page<?=empty($data['Items']) ? ' empty' : ''?> anix">
    <?php if(!empty($data['Items'])) { ?>
    <?php foreach($data['Items'] as $item) { ?>
    <article class="cart-item">
        <div class="photo" style="background-image: url(<?=$item->Product->Images->ImagesList[0]->Path?>)"></div>
        <div class="info">
            <h1><?=$item->Product->Title?></h1>
            <h2><span>Выбранный цвет:</span>&nbsp;<span><?=$item->ColorName != null ? $item->ColorName : 'По-умолчанию' ?></span></h2>
            <h2><span>Выбранный размер:</span>&nbsp;<span><?=$item->Size != null ? $item->Size : 'По-умолчанию' ?></span></h2>
            <h2><span>Стоимость:</span>&nbsp;<span><?=number_format($item->Product->Price, 2, ',', ' ')?> ₴</span></h2>
            <h2><span>Количество:</span>&nbsp;<button class="decrease" data-id="<?=$item->Product->ID?>">-</button><span class="amount"><?=$item->Amount?></span><button class="increase" data-id="<?=$item->Product->ID?>">+</button></h2>
        </div>
        <div class="remove">
            <button data-id="<?=$item->Product->ID?>" class="addtocart already">
                <p>
                    <span class="icon material-icons">
                        remove_shopping_cart
                    </span>
                    <span class="text">Убрать из корзины</span>
                </p>
            </button>
        </div>
    </article>
    <?php } ?>
    <div class="bottom">
        <div class="summ">
            Сумма: <?=number_format($data['TotalPrice'], 2, ',', ' ')?> ₴
        </div>
        <a href="<?=$this->Root?>/cart/order">
            <button>Оформить заказ</button>
        </a>
    </div>
    <?php } ?>
</section>