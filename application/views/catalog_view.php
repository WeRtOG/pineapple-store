<section class="catalog-wrapper">
    <section class="catalog">
        <h1 class="anix" data-hold="0" data-continue="true" data-fx="move" data-direction="down">Топ продаж</h1>
        <div class="carousel anix" data-fx="move" data-direction="down" data-continue="true">
            <?php foreach($data['CarouselItems'] as $item) { ?>
            <div class="card" data-id="<?=$item['ID']?>" style="background-image: url(<?=$folder_images . '/' . $item['Image']?>)"><h3><?=$item['Title']?></h3></div>
            <?php } ?>
        </div>
        <h1 class="anix" data-fx="move" data-direction="down" data-continue="true" data-hold="100">Сезонное предложение</h1>
        <div class="seasonal-offer anix" data-fx="move" data-direction="down" data-continue="true" data-hold="100">
            <?php foreach($data['SeasonalOfferItems'] as $item) { ?>
            <article data-id="<?=$item['ID']?>" class="item-card">
                <img src="<?=$folder_images . '/' . $item['Image']?>"/>
                <h2><?=$item['Title']?></h2>
                <h4><?=$item['WomanShoes'] ? 'Женская обувь' : 'Мужская обувь'?></h4>
                <h4>
                    <span>
                        Подробнее
                    </span>
                    <span class="material-icons">
                        keyboard_arrow_right
                    </span>
                </h4>
                <h3><?=number_format($item['Price'], 0, ',', ' ')?> ₴</h3>
                <button>
                    <p>
                        <span class="material-icons">
                            add_shopping_cart
                        </span>
                        <span>В корзину</span>
                    </p>
                </button>
            </article>
            <?php } ?>
        </div>
        <h1 class="anix" data-fx="move" data-direction="down" data-continue="true" data-hold="100">Все товары</h1>
        <section class="all-items">
            <div class="all-items-sidebar">
                <h2>
                    <span class="text">Фильтр</span>
                    <img src="<?=$this->Root?>/images/filter.svg"/>
                </h2>
            </div>
            <div class="all-items-content">
                <?php foreach($data['AllPreviewItems'] as $item) { ?>
                <article data-id="<?=$item['ID']?>" class="item-card">
                    <img src="<?=$folder_images . '/' . $item['Image']?>"/>
                    <h2><?=$item['Title']?></h2>
                    <h4><?=$item['WomanShoes'] ? 'Женская обувь' : 'Мужская обувь'?></h4>
                    <h4>
                        <span>
                            Подробнее
                        </span>
                        <span class="material-icons">
                            keyboard_arrow_right
                        </span>
                    </h4>
                    <h3><?=number_format($item['Price'], 0, ',', ' ')?> ₴</h3>
                    <button>
                        <p>
                            <span class="material-icons">
                                add_shopping_cart
                            </span>
                            <span>В корзину</span>
                        </p>
                    </button>
                </article>
                <?php } ?>
            </div>
        </section>
    </section>
</section>