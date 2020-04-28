<section class="catalog-wrapper">
    <section class="catalog">
        <?php if($data['Page'] == 1 && !$data['Filtered']) {
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
                    <div class="filters-list">
                        <ul class="collapsible<?=$data['Filter'] != 'brand' ? ' hidden' : ''?>">
                            <li class="header">
                                По брендам
                            </li>
                            <ul class="content">
                                <?php foreach($data['Brands'] as $brand) { ?>
                                <a href="<?=$this->Root?>/catalog/page/1/?filter=brand&id=<?=$brand->ID?>">
                                    <li><?=$brand->Name?></li>
                                </a>
                                <?php } ?>
                            </ul>
                        </ul>
                        <ul class="collapsible<?=$data['Filter'] != 'category' ? ' hidden' : ''?>">
                            <li class="header">
                                По категориям
                            </li>
                            <ul class="content">
                                <?php foreach($data['Categories'] as $category) { ?>
                                <?php if(count($category->SubCategories) == 0) { ?>
                                <a href="<?=$this->Root?>/catalog/page/1/?filter=category&id=<?=$category->ID?>">
                                    <li><?=$category->Name?></li>
                                </a>
                                <?php } else { ?>
                                <?php
                                    $hide = true;
                                    foreach($category->SubCategories as $subcategory)
                                        if($subcategory->ID == $data['FilterID'])
                                            $hide = false;
                                ?>
                                <li class="sub<?=$hide ? ' hidden' : ''?>">
                                    <div class="header"><?=$category->Name?></div>
                                    <ul class="content">
                                        <a href="<?=$this->Root?>/catalog/page/1/?filter=category&id=<?=$category->ID?>">
                                            <li>Все</li>
                                        </a>
                                        <?php foreach($category->SubCategories as $subcategory) { ?>
                                        <a href="<?=$this->Root?>/catalog/page/1/?filter=category&id=<?=$subcategory->ID?>">
                                            <li><?=$subcategory->Name?></li>
                                        </a>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <?php } ?>
                                <?php } ?>
                            </ul>
                        </ul>
                        <ul class="collapsible<?=$data['Filter'] != 'size' ? ' hidden' : ''?>">
                            <li class="header">
                                По размерам
                            </li>
                            <ul class="content">
                                <?php foreach($data['Sizes'] as $size) { ?>
                                <a href="<?=$this->Root?>/catalog/page/1/?filter=size&id=<?=$size->ID?>">
                                    <li><?=$size->Size?></a></li>
                                <?php } ?>
                            </ul>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="all-items-content<?=count($data['AllItems']) == 0 ? ' no-data' : ''?>">
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
        <?php if($data['PageCount'] > 1) { ?>
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

                $q_string = '';
                if(count($_GET) > 0) $q_string = '?' . http_build_query($_GET);

                // Выводим кнопки
                if($start != 1) {
                    echo '<a href="' . $this->Root . '/catalog/page/1/' . $q_string . '"><button class="page sw">&laquo;</button></a>';
                }
                for($i = $start; $i <= $end; $i++) {
                ?>
                <a href="<?=$this->Root?>/catalog/page/<?=$i?>/<?=$q_string?>"><button class="page<?=$page == $i ? ' current' : ''?>"><?=$i?></button></a>
                <?php
                }
                if($all_pages > $end) {
                    echo '<a href="' . $this->Root . '/catalog/page/' . $all_pages . '/' . $q_string . '"><button class="page sw">&raquo;</button></a>';
                }
            ?>
        </section>
        <?php } ?>
    </section>
</section>