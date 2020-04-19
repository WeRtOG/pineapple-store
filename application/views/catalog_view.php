<section class="catalog-wrapper">
    <section class="catalog">
        <?php if($data['Page'] == 1) {
        ?>
        <h1 class="anix" data-hold="0" data-continue="true" data-fx="move" data-direction="down">Топ продаж</h1>
        <div class="carousel anix" data-fx="move" data-direction="down" data-continue="true">
            <?php foreach($data['CarouselItems'] as $item) { ?>
            
            <div class="card" data-id="<?=$item->ID?>" style="background-image: url(<?=$item->Images->HorizontalImage->Path?>)"><a href="<?=$this->Root?>/catalog/product/<?=$item->ID?>"><h3><?=$item->Title?></h3></a></div>
            <?php } ?>
        </div>
        <h1 class="anix" data-fx="move" data-direction="down" data-continue="true" data-hold="100">Сезонное предложение</h1>
        <div class="seasonal-offer anix" data-fx="move" data-direction="down" data-continue="true" data-hold="100">
            <?php foreach($data['SeasonalOfferItems'] as $item) { ?>
            <a href="<?=$this->Root?>/catalog/product/<?=$item->ID?>">
                <article class="item-card">
                    <img src="<?=$item->Images->ImagesList[0]->Path?>"/>
                    <h2><?=$item->Title?></h2>
                    <h4><?=$item->Category->Name?></h4>
                    <h4>
                        <span>
                            Подробнее
                        </span>
                        <span class="material-icons">
                            keyboard_arrow_right
                        </span>
                    </h4>
                    <h3><?=number_format($item->Price, 0, ',', ' ')?> ₴</h3>
                    <button data-id="<?=$item->ID?>" class="addtocart<?=$item->InCart ? ' already' : ''?>">
                        <p>
                            <span class="icon material-icons">
                                <?=$item->InCart ? 'remove_shopping_cart' : 'add_shopping_cart'?>
                            </span>
                            <span class="text"><?=$item->InCart ? 'Убрать из корзины' : 'В корзину'?></span>
                        </p>
                    </button>
                </article>
            </a>
            <?php } ?>
        </div>
        <h1 class="anix" data-fx="move" data-direction="down" data-continue="true" data-hold="100">Все товары</h1>
        <?php
        } else {
        ?>
        <?php
        }
        ?>
        <section class="all-items anix">
            <div class="all-items-sidebar">
                <div class="filters">
                    <h2>
                        <span class="text">Фильтр</span>
                        <img src="<?=$this->Root?>/images/filter.svg"/>
                    </h2>
                </div>
            </div>
            <div class="all-items-content">
                <?php foreach($data['AllItems'] as $item) { ?>
                <a href="<?=$this->Root?>/catalog/product/<?=$item->ID?>">
                    <article class="item-card">
                        <img src="<?=$item->Images->ImagesList[0]->Path?>"/>
                        <h2><?=$item->Title?></h2>
                        <h4><?=$item->Category->Name?></h4>
                        <h4>
                            <span>
                                Подробнее
                            </span>
                            <span class="material-icons">
                                keyboard_arrow_right
                            </span>
                        </h4>
                        <h3><?=number_format($item->Price, 0, ',', ' ')?> ₴</h3>
                        <button data-id="<?=$item->ID?>" class="addtocart<?=$item->InCart ? ' already' : ''?>">
                            <p>
                                <span class="icon material-icons">
                                    <?=$item->InCart ? 'remove_shopping_cart' : 'add_shopping_cart'?>
                                </span>
                                <span class="text"><?=$item->InCart ? 'Убрать из корзины' : 'В корзину'?></span>
                            </p>
                        </button>
                    </article>
                </a>
                <?php } ?>
            </div>
        </section>
        <section class="page-select anix">
            <?
                // Получаем текующую страницу и кол-во страниц
                $page = $data['Page'];
                $all_pages = $data['PageCount'];

                // Рассчитываем кнопки
                $start = $page - 2;
                if($all_pages < 4)
                    $buttons = $all_pages;
                else
                    $buttons = 4;
                if($start < 1) {
                    $start = 1;
                }
                if($buttons < 4 && $all_pages > 4)
                    $buttons = $buttons + 2;
                $end = $buttons + $start;
                if($end > $all_pages) $end = $all_pages;

                // Выводим кнопки
                if($start != 1) {
                    echo '<a href="' . $this->Root . '/catalog/page/1"><button class="page sw">&laquo;</button></a>';
                }
                for($i = $start; $i <= $end; $i++) {
                ?>
                <a href="<?=$this->Root?>/catalog/page/<?=$i?>"><button class="page<?=$page == $i ? ' current' : ''?>"><?=$i?></button></a>
                <?php
                }
                if($all_pages > $end) {
                    echo '<a href="' . $this->Root . '/catalog/page/' . $all_pages . '"><button class="page sw">&raquo;</button></a>';
                }
            ?>
        </section>
    </section>
</section>