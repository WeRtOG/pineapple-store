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
                <h3 data-translate="content" class="changename">Изменить ФИО</h3>
                <h3 data-translate="content" class="changepassword">Изменить пароль</h3>
                <a class="logout" href="<?=$this->Root?>/auth/logout">
                    <span data-translate="content">Выйти</span>
                    <span class="material-icons">
                        exit_to_app
                    </span>
                </a>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="orders">
            <?php if(count($data['Orders']) > 0) { ?>
            <?php foreach($data['Orders'] as $order) { ?>
            <div class="order-wrapper" data-id="<?=$order->ID?>">
                <div class="order">
                    <div class="image" style="background-image: url(<?=$order->Items[0]->Product->Images->ImagesList[0]->Path?>)"></div>
                    <div class="info">
                        <h1 data-translate="content">Заказ #<?=$order->ID?></h1>
                        <h2><b data-translate="content">Статус заказа:</b>&nbsp;<span data-translate="content"><?=$order->Status->Name?></span></h2>
                        <h2><b data-translate="content">Общая стоимость заказа:</b>&nbsp;<?=number_format($order->TotalPrice, 2, ',', ' ')?> ₴</h2>
                        <h2><b data-translate="content">Доставка:</b>&nbsp;<?=$order->CityName?>,&nbsp;<span data-translate="content">отделение Новой Почты</span>&nbsp;№<?=$order->Warehouse?></h2>
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
                            <h2><b data-translate="content">Выбранный цвет: </b><span data-translate="content"><?=$item->ColorName != null ? $item->ColorName : 'По-умолчанию' ?></span></h2>
                            <h2><b data-translate="content">Выбранный размер: </b><span data-translate="content"><?=$item->Size != null ? $item->Size : 'По-умолчанию' ?></span></h2>
                            <h2><b data-translate="content">Стоимость: </b><?=$item->Amount?> <b>x</b> <?=number_format($item->Product->Price, 2, ',', ' ')?> <b>=</b> <?=number_format($item->Product->Price * $item->Amount, 2, ',', ' ')?> ₴</h2>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
            <?php } else { ?>
            <h1 class="empty">Заказов пока-что нет...</h1>
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
            <input data-translate="placeholder" required type="name" name="name" placeholder="Новое ФИО"/>
            <input data-translate="value" type="submit" value="Изменить"/>
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
            <input data-translate="placeholder" required minlength="6" name="password" type="password" placeholder="Новый пароль"/>
            <input data-translate="value" type="submit" value="Изменить"/>
        </form>
    </section>
</section>