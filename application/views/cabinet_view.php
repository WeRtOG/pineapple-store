<?php
    $avatar = $data['Client']->Avatar;
?>
<section class="cabinet anix" data-continue="true">
    <section class="sidebar">
        <div class="sidebar-content">
            <div class="user-info">
                <label for="AvatarUpload" class="avatar<?=$avatar->IsDefault ? ' default' : ''?>" style="background-image: url(<?=$avatar->Image->Path?>)"></label>
                <h2><?=$data['Client']->Name?></h2>
                <input type="file" accept="image/*" id="AvatarUpload"/>
            </div>
            <div class="actions">
                <h3 class="changename">Изменить имя</h3>
                <h3 class="changepassword">Изменить пароль</h3>
                <a class="logout" href="<?=$this->Root?>/auth/logout">
                    <span>Выйти</span>
                    <span class="material-icons">
                        exit_to_app
                    </span>
                </a>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="orders">
            <?php foreach($data['Orders'] as $order) { ?>
            <div class="order-wrapper" data-id="<?=$order->ID?>">
                <div class="order">
                    <div class="image" style="background-image: url(<?=$order->Items[0]->Product->Images->ImagesList[0]->Path?>)"></div>
                    <div class="info">
                        <h1>Заказ #<?=$order->ID?></h1>
                        <h2><b>Статус заказа: </b><?=$order->Status->Name?></h2>
                        <h2><b>Общая стоимость заказа: </b><?=number_format($order->TotalPrice, 2, ',', ' ')?> ₴</h2>
                        <h2><b>Доставка: </b><?=$order->CityName?>, отделение Новой Почты №<?=$order->Warehouse?></h2>
                    </div>
                    <button class="toggle">
                        <span class="material-icons">
                            keyboard_arrow_down
                        </span>
                    </button>
                </div>
                <div class="order-items">
                    <?php foreach($order->Items as $item) { ?>
                    <div class="item">
                        <div class="image" style="background-image: url(<?=$item->Product->Images->ImagesList[0]->Path?>)"></div>
                        <div class="info">
                            <h1><a href="<?=$this->Root?>/catalog/product/<?=$item->Product->ID?>" target="_blank"><?=$item->Product->Title?></a></h1>
                            <h2><b>Выбранный цвет: </b><?=$item->ColorName != null ? $item->ColorName : 'По-умолчанию' ?></h2>
                            <h2><b>Выбранный размер: </b><?=$item->Size != null ? $item->Size : 'По-умолчанию' ?></h2>
                            <h2><b>Стоимость: </b><?=$item->Amount?> <b>x</b> <?=number_format($item->Product->Price, 2, ',', ' ')?> <b>=</b> <?=number_format($item->Product->Price * $item->Amount, 2, ',', ' ')?> ₴</h2>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>
</section>
<section class="modal-wrapper changename hidden">
    <section class="modal">
        <button class="close">
            <span class="material-icons">
                close
            </span>
        </button>
        <form action="<?=$this->Root?>/cabinet/ChangeName" method="POST">
            <input required type="name" name="name" placeholder="Новое имя"/>
            <input type="submit" value="Изменить"/>
        </form>
    </section>
</section>
<section class="modal-wrapper changepassword hidden">
    <section class="modal">
        <button class="close">
            <span class="material-icons">
                close
            </span>
        </button>
        <form action="<?=$this->Root?>/cabinet/ChangePassword" method="POST">
            <input required minlength="6" name="password" type="password" placeholder="Новый пароль"/>
            <input type="submit" value="Изменить"/>
        </form>
    </section>
</section>