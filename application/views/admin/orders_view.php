<section class="cards orders">
    <?php foreach($data['Orders'] as $order) { ?>
        <div class="order-wrapper" data-id="<?=$order->ID?>">
            <div class="card order">
                <div class="image" style="background-image: url(<?=$order->Items[0]->Product->Images->ImagesList[0]->Path?>)"></div>
                <div class="info">
                    <h1>Заказ #<?=$order->ID?></h1>
                    <h2>
                        <b>Статус заказа:&nbsp;</b>
                        <form action="<?=$this->Root?>/admin/ChangeOrderStatus" method="POST">
                            <input type="hidden" name="id" value="<?=$order->ID?>" />
                            <input type="hidden" name="page" value="<?=$data['Page']?>"/>
                            <select class="status" name="status">
                                <?php foreach($data['Statuses'] as $status) { ?>
                                <?php print_r($status); ?>
                                <option value="<?=$status->ID?>"<?=$order->Status->ID == $status->ID ? ' selected' : ''?>><?=$status->Name?></option>
                                <?php } ?>
                            </select>
                        </form>
                    </h2>
                    <h2><b>Имя клиента:&nbsp;</b><?=$order->Client->Name?></h2>
                    <h2><b>Телефон клиента:&nbsp;</b><?=$order->Client->Phone?></h2>
                    <h2><b>Общая стоимость заказа:&nbsp;</b><?=number_format($order->TotalPrice, 2, ',', ' ')?> ₴</h2>
                    <h2><b>Доставка:&nbsp;</b><?=$order->CityName?>, отделение Новой Почты №<?=$order->Warehouse?></h2>
                </div>
                <button class="toggle">
                    <span class="material-icons">
                        keyboard_arrow_down
                    </span>
                </button>
            </div>
            <div class="card order-items">
                <?php foreach($order->Items as $item) { ?>
                <div class="item">
                    <div class="image" style="background-image: url(<?=$item->Product->Images->ImagesList[0]->Path?>)"></div>
                    <div class="info">
                        <h1><a href="<?=$this->Root?>/catalog/product/<?=$item->Product->ID?>" target="_blank"><?=$item->Product->Title?></a></h1>
                        <h2><b>Выбранный цвет:&nbsp;</b><?=$item->ColorName != null ? $item->ColorName : 'По-умолчанию' ?></h2>
                        <h2><b>Выбранный размер:&nbsp;</b><?=$item->Size != null ? $item->Size : 'По-умолчанию' ?></h2>
                        <h2><b>Стоимость:&nbsp;</b><?=$item->Amount?>&nbsp;<b>x</b>&nbsp;<?=number_format($item->Product->Price, 2, ',', ' ')?>&nbsp;<b>=</b>&nbsp;<?=number_format($item->Product->Price * $item->Amount, 2, ',', ' ')?> ₴</h2>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
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
                echo '<a href="' . $this->Root . '/admin/orders/1/' . $q_string . '"><button class="page sw">&laquo;</button></a>';
            }
            for($i = $start; $i <= $end; $i++) {
            ?>
            <a href="<?=$this->Root?>/admin/orders/<?=$i?>/<?=$q_string?>"><button class="page<?=$page == $i ? ' current' : ''?>"><?=$i?></button></a>
            <?php
            }
            if($all_pages > $end) {
                echo '<a href="' . $this->Root . '/admin/orders/' . $all_pages . '/' . $q_string . '"><button class="page sw">&raquo;</button></a>';
            }
        ?>
    </section>
    <?php } ?>
</section>